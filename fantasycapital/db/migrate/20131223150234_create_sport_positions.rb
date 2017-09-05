class CreateSportPositions < ActiveRecord::Migration
  def change
    create_table :sport_positions do |t|
      t.string :name
      t.string :sport
      t.integer :display_priority

      t.timestamps
    end
  end
end
