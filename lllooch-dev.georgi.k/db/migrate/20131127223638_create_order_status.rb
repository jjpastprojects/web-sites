class CreateOrderStatus < ActiveRecord::Migration
  def change
    create_table :order_statuses do |t|
      t.string :name, null: false
      t.string :type, null: false
    end
  end
end
