class CreateBankAccounts < ActiveRecord::Migration
  def change
    create_table :bank_accounts do |t|
       t.string :name
       t.string :stripe_id
       t.string :last_4
       t.integer :user_id
       t.timestamps
    end
  end
end
