class CreateCartGoods < ActiveRecord::Migration
  def change
    create_table :cart_goods do |t|
      t.references :cart, index: true
      t.references :good_option, index: true
      t.integer :price
      t.integer :quantity

      t.timestamps
    end
  end
end
