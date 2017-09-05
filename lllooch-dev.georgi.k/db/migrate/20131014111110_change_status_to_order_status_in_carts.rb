class ChangeStatusToOrderStatusInCarts < ActiveRecord::Migration
  def change
    remove_column :carts, :status_id
    add_column :carts, :order_status_id, :integer, index: true
  end
end
