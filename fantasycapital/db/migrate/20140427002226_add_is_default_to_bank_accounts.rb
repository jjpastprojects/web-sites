class AddIsDefaultToBankAccounts < ActiveRecord::Migration
  def change
    add_column :bank_accounts, :is_default, :boolean
  end
end
