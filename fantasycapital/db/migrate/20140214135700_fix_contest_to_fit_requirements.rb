class FixContestToFitRequirements < ActiveRecord::Migration
  def change
    remove_column :contests, :stats_id, :integer
    add_column :contests, :max_entries, :integer
  end
end
