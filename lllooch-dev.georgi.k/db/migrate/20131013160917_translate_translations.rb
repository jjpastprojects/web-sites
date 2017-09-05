class TranslateTranslations < ActiveRecord::Migration
  def up
    Translation.create_translation_table!({
      :value => :text
    }, {
      :migrate_data => true
    })
  end

  def down
    Translation.drop_translation_table! :migrate_data => true
  end
end
