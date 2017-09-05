class AddVisibleToSportPosition < ActiveRecord::Migration
  def change
    add_column :sport_positions, :visible, :boolean, default: true
  end
end
