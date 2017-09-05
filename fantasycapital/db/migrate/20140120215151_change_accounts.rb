class ChangeAccounts < ActiveRecord::Migration
  def change

    remove_column :accounts, :type
    remove_column :accounts, :ext_account_id
    remove_column :accounts, :balance

    add_column :accounts, :stripe_customer_id, :string
    add_column :accounts, :balance, :integer, :default => 0
    add_column :accounts, :lock_version, :integer, :default => 0
  end
end
