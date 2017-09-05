class AddContestEndToContest < ActiveRecord::Migration
  def change
    add_column :contests, :contest_end, :datetime
  end
end
