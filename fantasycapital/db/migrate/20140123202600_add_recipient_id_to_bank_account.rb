class AddRecipientIdToBankAccount < ActiveRecord::Migration
  def change
    add_column :bank_accounts, :recipient_id, :string
  end
end
