class AddIndexOnContestStart < ActiveRecord::Migration
  def change
    add_index :contests, :contest_start
  end
end
