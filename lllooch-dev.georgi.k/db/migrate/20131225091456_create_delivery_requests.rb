class CreateDeliveryRequests < ActiveRecord::Migration
  def change
    create_table :delivery_requests do |t|
      t.references :order, index: true
      t.text :params
      t.integer :price

      t.timestamps
    end
  end
end
