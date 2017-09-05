class CreateTransactions < ActiveRecord::Migration
  def change
    create_table :transactions do |t|
      t.integer :amount_in_cents
      t.integer :transaction_type
      t.integer :user_id
      t.integer :parent_transaction_id
      t.integer :payment_engine_type
      t.string :payment_engine_id
      t.text :notes

      t.timestamps
    end
  end
end
