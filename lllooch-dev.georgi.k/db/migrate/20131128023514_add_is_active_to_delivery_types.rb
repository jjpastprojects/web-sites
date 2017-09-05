class AddIsActiveToDeliveryTypes < ActiveRecord::Migration
  def change
    add_column :delivery_types, :is_active, :boolean, null: false, default: false
  end
end
