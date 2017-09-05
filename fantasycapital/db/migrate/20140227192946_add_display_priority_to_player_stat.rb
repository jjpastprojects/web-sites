class AddDisplayPriorityToPlayerStat < ActiveRecord::Migration
  def change
    add_column :player_stats, :display_priority, :integer
  end
end
