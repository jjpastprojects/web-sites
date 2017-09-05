class RemoveContestEndFromContests < ActiveRecord::Migration
  def change
    remove_column :contests, :contest_end, :datetime
  end
end
