class RemoveAddressFromOrders < ActiveRecord::Migration
  def change
    remove_column :orders, :address
  end
end
