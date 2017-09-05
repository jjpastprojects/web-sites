class CreateOrderGoods < ActiveRecord::Migration
  def change
    create_table :order_goods do |t|
      t.references :order, index: true, null: false
      t.references :good, index: true, null: false
      t.references :variant, index: true
      t.integer :price, null: false
      t.integer :quantity, null: false, default: 0
    end
  end
end
