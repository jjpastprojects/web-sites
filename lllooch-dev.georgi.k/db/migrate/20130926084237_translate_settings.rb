class TranslateSettings < ActiveRecord::Migration
  def up
    remove_column :settings, :value

    Setting.create_translation_table!({
      :value => :text
    }, {
      :migrate_data => true
    })
  end

  def down
    Setting.drop_translation_table! :migrate_data => true
  end

end
