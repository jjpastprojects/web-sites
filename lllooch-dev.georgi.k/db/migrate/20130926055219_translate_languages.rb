class TranslateLanguages < ActiveRecord::Migration
  def up
    remove_column :languages, :title

    Language.create_translation_table!({
      :title => :string
    }, {
      :migrate_data => true
    })
  end

  def down
    Language.drop_translation_table! :migrate_data => true
  end
end