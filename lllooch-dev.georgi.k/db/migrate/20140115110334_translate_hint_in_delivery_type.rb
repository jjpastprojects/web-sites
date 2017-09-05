class TranslateHintInDeliveryType < ActiveRecord::Migration
  def change
    add_column :delivery_type_translations, :hint, :text
    remove_column :delivery_types, :hint
  end
end
