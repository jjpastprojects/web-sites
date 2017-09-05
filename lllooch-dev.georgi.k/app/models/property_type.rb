# группа свойств товара
class PropertyType < ActiveRecord::Base
  include MultilingualModel
  translates :name
  validates :name, presence: true

  has_many :properties, dependent: :destroy
end
