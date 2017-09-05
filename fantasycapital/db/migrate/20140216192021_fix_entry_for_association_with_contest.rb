class FixEntryForAssociationWithContest < ActiveRecord::Migration
  def change
    remove_column :entries, :player_id, :integer
    remove_column :entries, :sport, :integer
    remove_column :entries, :sport_position_id, :integer
    add_reference :entries, :contest, index: true
  end
end
