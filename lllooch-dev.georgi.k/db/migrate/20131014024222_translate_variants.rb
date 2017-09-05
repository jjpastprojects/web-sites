class TranslateVariants < ActiveRecord::Migration
  def up
    Variant.create_translation_table!({
      :price => :string,
      :name => :string
    }, {
      :migrate_data => true
    })

    remove_column :variant_translations, :price
    add_column :variant_translations, :price, :decimal, null: false, default: 0
  end

  def down
    Variant.drop_translation_table! :migrate_data => true
  end
end
