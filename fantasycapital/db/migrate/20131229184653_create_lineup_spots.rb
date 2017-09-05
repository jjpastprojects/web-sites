class CreateLineupSpots < ActiveRecord::Migration
  def change
    create_table :lineup_spots do |t|
      t.references :sport_position, index: true
      t.references :lineup, index: true
      t.references :player, index: true
      t.integer :spot

      t.timestamps
    end
  end
end
