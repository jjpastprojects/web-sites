class CreatePaymentType < ActiveRecord::Migration
  def change
    create_table :payment_types do |t|
      t.string :name, null: false
      t.string :type, null: false
    end
  end
end
