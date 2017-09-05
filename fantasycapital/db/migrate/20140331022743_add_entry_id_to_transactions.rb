class AddEntryIdToTransactions < ActiveRecord::Migration
  def change
    add_column :transactions, :entry_id, :integer
  end
end
