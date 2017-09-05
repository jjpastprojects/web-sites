class RenameOpponentTeamToAwayTeamInProjectionGame < ActiveRecord::Migration
  def change
    rename_column :projection_games, :opponent_team_id, :away_team_id
  end
end
