# тэг
class Tag < ActiveRecord::Base
  include MultilingualModel
  translates :title

  has_and_belongs_to_many :goods
  validates :name, presence: true
end
