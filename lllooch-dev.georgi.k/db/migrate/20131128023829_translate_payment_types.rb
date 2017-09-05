class TranslatePaymentTypes < ActiveRecord::Migration
  def up
    remove_column :payment_types, :name

    PaymentType.create_translation_table!({
                                              :name => :string
                                          }, {
                                              :migrate_data => true
                                          })
  end

  def down
    PaymentType.drop_translation_table! :migrate_data => true
  end
end
