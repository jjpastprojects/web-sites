class CreateDeliveryTypePaymentTypes < ActiveRecord::Migration
  def change
    create_table :delivery_types_payment_types do |t|
      t.belongs_to :delivery_type
      t.belongs_to :payment_type
    end

    add_index :delivery_types_payment_types, [:delivery_type_id, :payment_type_id], name: 'delivery_type_payment_type'
  end
end
