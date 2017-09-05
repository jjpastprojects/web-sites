# модель элемента меню
class MenuItem < ActiveRecord::Base
  include MultilingualModel
  include AutotitleableModel

  default_scope { order('weight') }
  
  translates :title

  belongs_to :page
  belongs_to :menu
  has_many :menu_items
  belongs_to :menu_item

  validates :name, presence: true

  # алиас: вложенные элементы
  def items
    menu_items
  end

  # роуты привязанной страницы
  def routes
    page.routes
  end

  # урл привязанной страницы
  def url
    unless page.nil?
      page.url
    else
      self[:url]
    end
  end

  # генерация метода хелпера роута по привязанной странице
  def path
    unless page.nil?
      page.routes.first[:as] + '_path'      
    end
  end
end
