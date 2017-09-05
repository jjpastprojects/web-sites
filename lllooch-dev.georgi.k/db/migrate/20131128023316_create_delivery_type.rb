class CreateDeliveryType < ActiveRecord::Migration
  def change
    create_table :delivery_types do |t|
      t.string :name, null: false
      t.string :type, null: false
      t.integer :price, null: false, default: 0
      t.text :conditions
    end
  end
end
