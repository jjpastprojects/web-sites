class CreateAccounts < ActiveRecord::Migration
  def change
    create_table :accounts do |t|
      t.references :user, index: true
      t.string :type
      t.string :ext_account_id
      t.decimal :balance, scale: 2, precision: 20

      t.timestamps
    end
  end
end
