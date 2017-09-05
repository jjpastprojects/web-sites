class AddWeightToPaymentTypes < ActiveRecord::Migration
  def change
    add_column :payment_types, :weight, :integer, null: false, default: 9999
  end
end
