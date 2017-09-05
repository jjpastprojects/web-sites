# свойство товара
class Property < ActiveRecord::Base
  include MultilingualModel
  belongs_to :property_type
  translates :name

  validates :name, presence: true
end
