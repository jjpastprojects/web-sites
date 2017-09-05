# модель элемента заказа
class OrderGood < ActiveRecord::Base
  belongs_to :order
  belongs_to :good
  belongs_to :variant

  validates :good, presence: true
  validates :order, presence: true

  # делегирование метода в товар:
  # good_name = good.name, good.slug = good_slug
  delegate :name, :slug, to: :good, prefix: true, allow_nil: true
  delegate :good_weight, :good_volume, to: :good, allow_nil: true

  # creates instance from good
  def self.from_good good
    self.new(good: good, quantity: 1, price: good.price)
  end

  def article
    variant.present? ? variant.full_article : good.article
  end

  def full_price

    if self.good.name.downcase == "starwire"
      3360 * quantity
    else
      price * quantity
    end


  end
end
