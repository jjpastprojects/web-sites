class AddEntrisCounterToContest < ActiveRecord::Migration
  def change
    remove_column :contests, :lineups_count, :integer
    add_column :contests, :entries_count, :integer, default: 0
  end
end
