class AddContestdateToContests < ActiveRecord::Migration
  def change
    add_column :contests, :contestdate, :date
  end
end
