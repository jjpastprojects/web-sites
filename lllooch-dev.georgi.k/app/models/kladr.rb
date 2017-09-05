class Kladr < ActiveRecord::Base
  validates :city, :code, presence: true, uniqueness: true
end