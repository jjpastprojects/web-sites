class AddWeightToDeliveryTypes < ActiveRecord::Migration
  def change
    add_column :delivery_types, :weight, :integer, null: false, default: 9999
  end
end
