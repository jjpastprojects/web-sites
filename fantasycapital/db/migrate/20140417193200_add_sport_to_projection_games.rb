class AddSportToProjectionGames < ActiveRecord::Migration
  def change
    add_column :projection_games, :sport, :string, default: "NBA"
  end
end
