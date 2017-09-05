class AddSportToProjectionScheduledGames < ActiveRecord::Migration
  def change
    add_column :projection_scheduled_games, :sport, :string, default: "NBA"
  end
end
