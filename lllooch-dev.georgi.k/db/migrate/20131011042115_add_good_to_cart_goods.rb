class AddGoodToCartGoods < ActiveRecord::Migration
  def change
    add_reference :cart_goods, :good, index: true
  end
end
