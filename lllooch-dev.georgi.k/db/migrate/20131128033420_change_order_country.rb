class ChangeOrderCountry < ActiveRecord::Migration
  def change
    remove_column :orders, :country_id
    change_table :orders do |t|
      t.string :country, null: false, default: 'RU'
    end
  end
end
