# модель дизайнера
# сортируется по порядковому номеру (d&d в админке)
class Designer < ActiveRecord::Base
  include MultilingualModel
  include AutotitleableModel

  translates :name, :title, :heading, :keywords, :description, :content, :motto

  has_and_belongs_to_many :goods
  has_many :design_items

  validates :name, presence: true

  default_scope { order(:weight) }

  attr_accessor :avatar

  has_attached_file :avatar,
    styles: {preview: "400x400#", admin: "30x30#"},
    default_url: "/images/:style/missing.png",
    url: "/uploads/designers/:id/logo/:style/:basename.:extension",
    path: ":rails_root/public/uploads/designers/:id/logo/:style/:basename.:extension"

  validates :avatar, :attachment_presence => true
  validates_attachment_content_type :avatar, :content_type => ['image/jpeg', 'image/png','image/gif']


  def all_projects
    projects = []

    projects += self.goods + self.design_items
  end
end
