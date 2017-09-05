class AddIndexToProjectionStat < ActiveRecord::Migration
  def change
    add_index :projection_stats, [:player_id, :game_id, :stat_name]
  end
end
