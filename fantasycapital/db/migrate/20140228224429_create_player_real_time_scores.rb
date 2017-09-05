class CreatePlayerRealTimeScores < ActiveRecord::Migration
  def change
    create_table :player_real_time_scores do |t|
      t.string :name
      t.decimal :value
      t.references :player, index: true

      t.timestamps
    end
  end
end
