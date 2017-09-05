# Более не используется
# TODO safe_delete
class CartGood < ActiveRecord::Base
  belongs_to :cart
  belongs_to :good
  belongs_to :variant
  belongs_to :good_option

  def self.from_good good
    self.new({
      good: good,
      quantity: 1
    })
  end
end
