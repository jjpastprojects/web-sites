class CreateCreditCards < ActiveRecord::Migration
  def change
    create_table :credit_cards do |t|
      t.string :stripe_id
      t.boolean :is_default
      t.string :card_brand
      t.string :last_four
      t.integer :user_id
      t.timestamps
    end
  end
end
