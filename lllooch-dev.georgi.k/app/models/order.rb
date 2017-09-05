# модель заказа.
# все лежит в одной таблице, в зависимости от текущего типа подтягиваются валидации
# и методы для текущего типа
#
# STI:
# - cart      корзина
# - preorder  предзаказ
# - robust    заказ
class Order < ActiveRecord::Base
  belongs_to :language

  belongs_to :order_status
  belongs_to :delivery_type
  belongs_to :payment_type

  belongs_to :client, autosave: true

  has_many :order_goods, autosave: true
  has_one :delivery_request

  delegate :first_name, :last_name, :email, :phone, to: :client, allow_nil: true

  validates :token, presence: true, uniqueness: true
  validates_with OrderValidator

  # товары заказа
  def items
    self.order_goods
  end

  # пропускаем ли валидации?
  def skip_validations?
    true if self.order_status == OrderStatus::Canceled.first
  end

  # имя клиента
  def full_name
    self.client.full_name if self.client.present?
  end

  # данные для расчета доставки
  def delivery_params
    self.attributes.select{|k, v| self.class.delivery_params.include?(k.to_sym)}
  end

  # поля, обязательные для расчета доставки
  def self.delivery_params
    [:country, :city, :region, :zip, :street, :street_number]
  end

  # стоимость товаров
  def items_price
    price = 0
    price += items.map(&:full_price).sum unless items.empty?
    price
  end

  # стоимость доставки
  def delivery_price
    price = 0
    if self.delivery_type.present?
      if self.delivery_type.is_cost_calc_needed?
        price += self.delivery_request.price if self.delivery_request.present?
      else
        price += self.delivery_type.price if self.delivery_type.present?
      end
    end
    price
  end

  # пока так
  def payment_price
    0
  end

  def total_price
    price = []
    price << items_price if items_price > 0
    price << delivery_price if delivery_price > 0
    price << payment_type if payment_price > 0

    price.sum
  end

  def items_quantity
    order_goods.map(&:quantity).sum
  end

  def items_weight(kilograms = false)
    weight = 0
    order_goods.each do |g|
      weight += (g.good_weight.present? ? g.good_weight : 0) * (g.quantity.present? ? g.quantity : 0)
    end

    kilograms == true ? weight.to_f / 1000 : weight
  end

  def items_volume(cubic_meters = false)
    volume = 0
    order_goods.each do |g|
      volume += (g.good_volume.present? ? g.good_volume : 0) * (g.quantity.present? ? g.quantity : 0)
    end

    cubic_meters == true ? volume.to_f / 1000000 : volume
  end

  # опции для формы заказа
  # возвращается хэш с услугами и стоимость товаров
  def options
    {
        delivery_types: DeliveryType.active.index_by(&:id).each_with_object({}) {|(key, value), hash| hash[key] = value.options },
        payment_types: PaymentType.active.index_by(&:id).each_with_object({}) { |(key, value), hash| hash[key] = value.options },
        items_price: self.items_price
    }
  end

  # полная стоимость заказа
  def full_price
    self.items_price + self.delivery_price + self.payment_price
  end

  # адрес в одну строку через запятые
  def full_address
    address = []

    address << self.zip if self.zip.present?
    address << Country[self.country].name if self.country.present?
    address << self.city if self.city.present?
    address << self.address if self.city.present?

    address.join ', '
  end

  def address
    address = []

    address << self.street if street.present?
    address << "д. " + self.street_number if street_number.present?
    address << "кв. " + self.site if site.present?

    address.join ', '
  end

  # генератор ключа корзины
  def self.token
    o = [('a'..'z'), ('A'..'Z')].map { |i| i.to_a }.flatten
    (0...50).map{ o[rand(o.length)] }.join
  end
end
