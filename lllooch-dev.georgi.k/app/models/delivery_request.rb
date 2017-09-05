class DeliveryRequest < ActiveRecord::Base
  belongs_to :order
  belongs_to :delivery_type

  validates :order, presence: true, uniqueness: true
  validates :delivery_type, presence: true
end
