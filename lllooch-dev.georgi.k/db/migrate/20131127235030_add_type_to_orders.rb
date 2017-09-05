class AddTypeToOrders < ActiveRecord::Migration
  def change
    add_column :orders, :type, :string, null:false, default: 'Order::Cart'
  end
end
