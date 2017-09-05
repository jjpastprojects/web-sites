class AddVariationToCartGoods < ActiveRecord::Migration
  def change
    add_reference :cart_goods, :variant, index: true
  end
end
