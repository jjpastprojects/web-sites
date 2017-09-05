class AddStreetToOrder < ActiveRecord::Migration
  def change
    add_column :orders, :street, :string
  end
end
