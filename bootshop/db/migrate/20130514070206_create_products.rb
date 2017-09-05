class CreateProducts < ActiveRecord::Migration
  def change
    create_table :products do |t|
      t.string :name
      t.decimal :price
      t.integer :quantity
      t.references :user

      t.timestamps
    end
    add_index :products, :user_id
  end
end
