class CreateLineupSpotProtos < ActiveRecord::Migration
  def change
    create_table :lineup_spot_protos do |t|
      t.string :sport
      t.string :sport_position_name
      t.integer :spot

      t.timestamps
    end
  end
end
