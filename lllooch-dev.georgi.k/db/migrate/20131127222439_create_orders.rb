class CreateOrders < ActiveRecord::Migration
  def change
    create_table :orders do |t|
      t.references :client, index: true

      t.references :order_status, index: true
      t.references :delivery_type, index: true
      t.references :payment_type, index: true

      t.references :country, index: true
      t.string :token, null: false
      t.string :city
      t.string :region
      t.string :address
      t.string :zip

      t.timestamps
    end
  end
end
