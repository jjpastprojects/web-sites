class TranslateDeliveryTypes < ActiveRecord::Migration
  def up
    remove_column :delivery_types, :name

    DeliveryType.create_translation_table!({
                                               :name => :string
                                           }, {
                                               :migrate_data => true
                                           })
  end

  def down
    DeliveryType.drop_translation_table! :migrate_data => true
  end
end
