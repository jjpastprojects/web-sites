# Модель корзины,
# более не используется
class Cart < ActiveRecord::Base
  belongs_to :order_status
  belongs_to :payment
  belongs_to :language

  has_many :cart_goods, autosave: true

  belongs_to :delivery_type
  belongs_to :payment_type

  validates :key, presence: true, uniqueness: true
  validates :email, email: true

  def items
    cart_goods
  end

  def full_name
    [name, surname].join(' ')
  end

  def full_price
    _price = 0

    unless items.empty?

      _price += items.map{|cart_good| cart_good.price.to_i}.reduce(:+)
    end
  end

  # генерация ключа, который кладется в кукис
  # кукис используется потому, что ему можно задать очень большое время до момента,
  # как он "протухнет", а токен — просто уникальный айди, чтобы не светить айдишники лишний раз
  def self.token
    o   = [('a'..'z'), ('A'..'Z')].map { |i| i.to_a }.flatten
    (0...50).map{ o[rand(o.length)] }.join
  end
end
