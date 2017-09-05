class TranslateDeliveryTypesConditions < ActiveRecord::Migration
  def change
    add_column :delivery_type_translations, :conditions, :text
  end
end
