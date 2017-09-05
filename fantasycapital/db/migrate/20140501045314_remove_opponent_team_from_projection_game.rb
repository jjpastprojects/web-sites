class RemoveOpponentTeamFromProjectionGame < ActiveRecord::Migration
  def change
    remove_column :projection_games, :opponent_team_id, :integer
    remove_column :projection_games, :team_id, :integer
  end
end
