class TranslateMenuItems < ActiveRecord::Migration
  def up
    remove_column :menu_items, :title

    MenuItem.create_translation_table!({
      :title => :string
    }, {
      :migrate_data => true
    })
  end

  def down
    MenuItem.drop_translation_table! :migrate_data => true
  end
end
