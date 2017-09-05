class TranslateDesignItems < ActiveRecord::Migration
  def up
    remove_column :design_items, :name

    DesignItem.create_translation_table!({
                                       :name => :string
                                   }, {
                                       :migrate_data => true
                                   })
  end

  def down
    DesignItem.drop_translation_table! :migrate_data => true
  end
end
