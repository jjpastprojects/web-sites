class CreateGameScores < ActiveRecord::Migration
  def change
    create_table :game_scores do |t|
      t.date :playdate
      t.string :ext_game_id
      t.datetime :scheduledstart
      t.references :home_team, index: true
      t.references :away_team, index: true
      t.integer :home_team_score
      t.integer :away_team_score
      t.string :status
      t.string :clock
      t.integer :period
      t.timestamps
    end
  end
end
