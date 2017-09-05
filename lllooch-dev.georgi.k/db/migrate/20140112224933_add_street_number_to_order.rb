class AddStreetNumberToOrder < ActiveRecord::Migration
  def change
    add_column :orders, :street_number, :string
  end
end
