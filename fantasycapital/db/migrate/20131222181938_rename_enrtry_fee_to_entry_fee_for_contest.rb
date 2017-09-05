class RenameEnrtryFeeToEntryFeeForContest < ActiveRecord::Migration
  def change
    rename_column :contests, :enrtry_fee, :entry_fee
  end
end
