class FixLineupForAssociationWithContest < ActiveRecord::Migration
  def change
    remove_column :lineups, :contest_id, :integer
    add_column :lineups, :sport, :string
  end
end
