class ChangeStatsIdToExtId < ActiveRecord::Migration
  def change
    remove_column :projection_teams, :stats_team_id, :integer
    add_column :projection_teams, :ext_team_id, :string
    remove_column :projection_players, :stats_player_id, :integer
    add_column :projection_players, :ext_player_id, :string
    remove_column :projection_games, :stats_event_id, :integer
    add_column :projection_games, :ext_game_id, :string
    remove_column :projection_scheduled_games, :stats_event_id, :integer
    add_column :projection_scheduled_games, :ext_game_id, :string
  end
end
