class CreateCarts < ActiveRecord::Migration
  def change
    create_table :carts do |t|
      t.string :key
      t.references :status, index: true
      t.references :payment, index: true
      t.references :delivery
      t.string :name
      t.string :surname
      t.string :city
      t.string :region
      t.string :address
      t.string :zip

      t.timestamps
    end
  end
end
