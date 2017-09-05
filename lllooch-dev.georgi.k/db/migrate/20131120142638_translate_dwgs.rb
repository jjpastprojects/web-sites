class TranslateDwgs < ActiveRecord::Migration
  def up
    Dwg.create_translation_table!({
                                      :name => :string
                                  }, {
                                      :migrate_data => true
                                  })
  end

  def down
    Dwg.drop_translation_table! :migrate_data => true
  end

end
