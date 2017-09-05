class RemoveIndexUniqunessFromEntry < ActiveRecord::Migration
  def change
    remove_index :entries, [:lineup_id, :contest_id]
    add_index :entries, [:lineup_id, :contest_id]
  end
end
