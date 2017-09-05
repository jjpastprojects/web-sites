class AddIndexSportPosition < ActiveRecord::Migration
  def change
    add_index :sport_positions, [:name, :sport], :unique => true
  end
end
