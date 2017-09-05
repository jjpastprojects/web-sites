# модель меню
class Menu < ActiveRecord::Base
  include SortedByName  
  validates :name, presence: true
  validates :key, presence: true, uniqueness: true

  has_many :menu_items, dependent: :destroy

  # рутовые элементы меню
  def items
    menu_items.where('menu_item_id is null')
  end
end
