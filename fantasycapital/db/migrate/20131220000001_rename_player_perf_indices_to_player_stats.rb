class RenamePlayerPerfIndicesToPlayerStats < ActiveRecord::Migration
    def change
        rename_table :player_perf_indices, :player_stats
    end 
end
