class DeliveryType < ActiveRecord::Base
  include MultilingualModel
  translates :name, :conditions, :hint

  has_and_belongs_to_many :payment_types
  has_one :delivery_request

  default_scope { order(:weight) }

  scope :active, -> { where(is_active: true) }

  validates :type, presence: true, uniqueness: true
  validates :name, presence: true
  validates :layout, presence: true
  validates :payment_types, length: { minimum: 1 }

  def options
    {
        name: self.name,
        conditions: self.conditions,
        hint: self.hint,
        price: self.price,
        layout: self.layout,
        payment_types: self.payment_types.map(&:id)
    }
  end

  def calculate(order, params)
    self.calculation_error
    false
  end

  def create_request(order, params, price)
    order = order || self.order
    request = DeliveryRequest.find_or_create_by(order: order)
    request.delivery_type = self
    request.params = params.to_json
    request.price = price
    request.save!
  end

  def calculation_error(error = 'Неизвестная ошибка')
    self.errors[:calculate] << error if error.present?
  end

  def is_cost_calc_needed?
    self.class.is_cost_calc_needed?
  end

  def self.is_cost_calc_needed?
    false
  end

  def self.types
    {
        'DeliveryType::Courier' => 'Курьером',
        'DeliveryType::Pickup' => 'Самовывоз',
        'DeliveryType::Showroom' => 'Шоурум',
        'DeliveryType::Dellin' => 'Деловые линии',
        'DeliveryType::Dpd' => 'DPD'
    }
  end

  def self.layouts
    {
        'address_and_payment' => 'Адрес/Оплата',
        'payment' => 'Оплата'
    }
  end
end
