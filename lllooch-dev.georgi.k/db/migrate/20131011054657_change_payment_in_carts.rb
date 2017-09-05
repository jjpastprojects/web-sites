class ChangePaymentInCarts < ActiveRecord::Migration
  def change
    rename_column :carts, :payment_id, :paymentr_type_id
  end
end
