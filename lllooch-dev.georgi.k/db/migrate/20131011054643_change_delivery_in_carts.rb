class ChangeDeliveryInCarts < ActiveRecord::Migration
  def change
    rename_column :carts, :delivery_id, :delivery_type_id
  end
end
