class CreateProjectionScheduledGames < ActiveRecord::Migration
  def change
    create_table :projection_scheduled_games do |t|
      t.references :home_team, index: true
      t.references :away_team, index: true
      t.datetime :start_date
      t.integer :stats_event_id

      t.timestamps
    end
  end
end
