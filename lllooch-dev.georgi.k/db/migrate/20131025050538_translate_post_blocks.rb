class TranslatePostBlocks < ActiveRecord::Migration
  def up
    PostBlock.create_translation_table!({
                                          :content => :text
                                      }, {
                                          :migrate_data => true
                                      })
  end

  def down
    PostBlock.drop_translation_table! :migrate_data => true
  end
end
