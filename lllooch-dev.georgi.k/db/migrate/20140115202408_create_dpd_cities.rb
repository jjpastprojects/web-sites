class CreateDpdCities < ActiveRecord::Migration
  def change
    create_table :dpd_cities do |t|
      t.string :city_id, null: false
      t.string :city, null: false
      t.string :region, null: false

      t.timestamps
    end
  end
end
