class TranslatePropertyTypes < ActiveRecord::Migration
  def up
    PropertyType.create_translation_table!({
      :name => :string
    }, {
      :migrate_data => true
    })
  end

  def down
    PropertyType.drop_translation_table! :migrate_data => true
  end
end
