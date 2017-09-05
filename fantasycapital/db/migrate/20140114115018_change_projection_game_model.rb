class ChangeProjectionGameModel < ActiveRecord::Migration
  def change
    add_column :projection_games, :stats_event_id, :integer
    remove_column :projection_games, :is_home, :boolean
    rename_column :projection_games, :gamedate, :start_date
    rename_column :projection_games, :home_team_id, :team_id
    rename_column :projection_games, :away_team_id, :opponent_team_id
    add_index :projection_games, [:team_id, :stats_event_id]
  end
end
