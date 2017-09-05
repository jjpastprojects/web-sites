class AddIsActiveToPaymentTypes < ActiveRecord::Migration
  def change
    add_column :payment_types, :is_active, :boolean
  end
end
