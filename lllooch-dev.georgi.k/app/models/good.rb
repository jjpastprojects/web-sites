# модель товара
# по большему счету тут все наглядно:
# - картинки, зависимости, валидации и переводы
# - алиас для категорий
# - расчет минимальной цены из вариантов
# - проверка наличия вариантов с картинкой материала
class Good < ActiveRecord::Base
  include ActionView::Helpers::NumberHelper
  include ActionView::Helpers::TagHelper
  include MultilingualModel
  include SluggableModel
  include AutotitleableModel

  default_scope { order('weight, name') }

  translates :price, :title, :heading, :keywords, :description, :announce, :content, :additional, :material_type_text

  has_and_belongs_to_many :good_category
  has_and_belongs_to_many :designer
  has_and_belongs_to_many :material
  has_and_belongs_to_many :property_type

  has_and_belongs_to_many :tags
  has_and_belongs_to_many :goods, foreign_key: 'parent_id'

  has_one :video
  has_one :category_good
  delegate :weight, to: :category_good, prefix: true, allow_nil: true
  has_many :files, dependent: :destroy, class_name: 'GoodFile'
  has_many :dwgs, dependent: :destroy, class_name: 'GoodFile::Dwg'
  has_many :pdfs, dependent: :destroy, class_name: 'GoodFile::Pdf'

  has_many :variants, dependent: :destroy

  has_many :three60s, -> { where media_file_id: nil}, dependent: :destroy
  validates :name, presence: true
  validates :article, presence: true
  # validates :designer, presence: true

  attr_accessor :thumb
  attr_accessor :logo
  attr_accessor :logo_desc

  attr_accessor :picture
  attr_accessor :portrait
  attr_accessor :landscape

  attr_accessor :panorama
  attr_accessor :panorama_ipad

  has_attached_file :logo, 
    styles: {preview: "300x300#"},
    default_url: "/images/:style/missing.png",
    url: "/uploads/goods/:id/logo/:style/:basename.:extension",
    path: ":rails_root/public/uploads/goods/:id/logo/:style/:basename.:extension"

  has_attached_file :logo_desc, 
    styles: {preview: "400x30>"},
    default_url: "/images/:style/missing.png",
    url: "/uploads/goods/:id/logo_desc/:style/:basename.:extension",
    path: ":rails_root/public/uploads/goods/:id/logo_desc/:style/:basename.:extension"

  has_attached_file :thumb, 
    styles: {preview: "300x300#", cart: "400x400#", additional: '90x90#', admin: "30x30#"},
    default_url: "/images/:style/missing.png",
    url: "/uploads/goods/:id/thumb/:style/:basename.:extension",
    path: ":rails_root/public/uploads/goods/:id/thumb/:style/:basename.:extension"

  has_attached_file :portrait, 
    styles: {
      picture: "3000x3000>",
      normal: "768x1024#", 
      admin: "30x30#", 
      preview: '100x100#'
    },
    default_url: "/images/:style/missing.png",
    url: "/uploads/goods/:id/portrait/:style/:basename.:extension",
    path: ":rails_root/public/uploads/goods/:id/portrait/:style/:basename.:extension",
    convert_options: { picture: "-quality 79" }

  has_attached_file :landscape, 
    styles: {
      picture: "3000x3000>",
      normal: "1024x768#", 
      admin: "30x30#", 
      preview: '100x100#'
    },
    default_url: "/images/:style/missing.png",
    url: "/uploads/goods/:id/landscape/:style/:basename.:extension",
    path: ":rails_root/public/uploads/goods/:id/landscape/:style/:basename.:extension",
    convert_options: { picture: "-quality 79" }

  has_attached_file :picture, 
    styles: {
      picture: "3000x3000>",
      preview: "300x300#"
    },
    default_url: "/images/:style/missing.png",
    url: "/uploads/goods/:id/picture/:style/:basename.:extension",
    path: ":rails_root/public/uploads/goods/:id/picture/:style/:basename.:extension",
    convert_options: { picture: "-quality 79" }

  has_attached_file :panorama, 
    styles: {
      picture: "3000x3000>",
      preview: "300x300#"
    },
    default_url: "/images/:style/missing.png",
    url: "/uploads/goods/:id/panorama/:style/:basename.:extension",
    path: ":rails_root/public/uploads/goods/:id/panorama/:style/:basename.:extension",
    convert_options: { picture: "-quality 79" }

  has_attached_file :panorama_ipad, 
    styles: {
      picture: "3000x3000>",
      preview: "300x300#"
    },
    default_url: "/images/:style/missing.png",
    url: "/uploads/goods/:id/panorama/ipad/:style/:basename.:extension",
    path: ":rails_root/public/uploads/goods/:id/panorama/ipad/:style/:basename.:extension",
    convert_options: { picture: "-quality 79" }

  validates_attachment_content_type :panorama, :content_type => ['image/jpeg', 'image/png','image/gif']
  validates_attachment_content_type :panorama_ipad, :content_type => ['image/jpeg', 'image/png','image/gif']

  validates :logo, :attachment_presence => true
  validates_attachment_content_type :logo, :content_type => ['image/jpeg', 'image/png','image/gif']

  #validates :logo_desc, :attachment_presence => true
  validates_attachment_content_type :logo_desc, :content_type => ['image/jpeg', 'image/png','image/gif']

  validates :thumb, :attachment_presence => true
  validates_attachment_content_type :thumb, :content_type => ['image/jpeg', 'image/png','image/gif']

  validates :picture, :attachment_presence => true
  validates_attachment_content_type :picture, :content_type => ['image/jpeg', 'image/png','image/gif']

  # validates :portrait, :attachment_presence => true
  validates_attachment_content_type :portrait, :content_type => ['image/jpeg', 'image/png','image/gif']

  # validates :landscape, :attachment_presence => true
  validates_attachment_content_type :landscape, :content_type => ['image/jpeg', 'image/png','image/gif']

  def categories
    good_category
  end

  def best_price
    best_price = price

    unless variants.empty?
      prices = variants.map{|v| v.price }

      best_price = variants.min_by {|v| v.price}.price
      ((content_tag(:small, 'от') + ' ') unless (prices.uniq.size == 1)).to_s + number_to_currency(best_price, precision: 0, unit: 'р.').to_s
    else 
      number_to_currency(best_price, precision: 0, unit: 'р.')
    end
  end

  def pictures
    {
      preload: {
        desktop: picture.url(:picture)
      },
      images: {
        retina_portrait: portrait.url(:picture),
        retina_landscape: landscape.url(:picture),
        portrait: portrait.url(:normal),
        landscape: landscape.url(:normal)
      }
    }
  end

  def material_types
    self.variants.select{|v| v.material.present? && v.is_material }
  end

  def has_any_material_type?
    self.material_types.size > 0
  end

end
