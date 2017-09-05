class MoveFpFromProjectionStatsToProjectionPlayers < ActiveRecord::Migration
  def change
   add_column :projection_players, :fp, :decimal 
   remove_column :projection_stats, :fp, :decimal 
  end
end
