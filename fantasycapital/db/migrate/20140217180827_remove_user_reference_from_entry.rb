class RemoveUserReferenceFromEntry < ActiveRecord::Migration
  def change
    remove_column :entries, :user_id, :integer
    add_index :entries, [:lineup_id, :contest_id], :unique => true
  end
end
