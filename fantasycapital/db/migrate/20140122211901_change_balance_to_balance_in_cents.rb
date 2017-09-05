class ChangeBalanceToBalanceInCents < ActiveRecord::Migration
  def change
    rename_column :accounts, :balance, :balance_in_cents
  end
end
