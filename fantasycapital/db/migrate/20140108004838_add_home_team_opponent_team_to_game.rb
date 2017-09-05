class AddHomeTeamOpponentTeamToGame < ActiveRecord::Migration
  def change
    add_reference :projection_games, :home_team, index: true
    add_reference :projection_games, :opponent_team, index: true
  end
end
