class AddStatsIdToContests < ActiveRecord::Migration
  def change
    add_column :contests, :stats_id, :integer
    add_index :contests, :stats_id
  end
end
