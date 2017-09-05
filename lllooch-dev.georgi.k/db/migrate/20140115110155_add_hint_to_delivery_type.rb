class AddHintToDeliveryType < ActiveRecord::Migration
  def change
    add_column :delivery_types, :hint, :text
  end
end
