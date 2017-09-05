class TranslateMaterials < ActiveRecord::Migration
  def up
    Material.create_translation_table!({
      :title => :string,
      :description => :text
    }, {
      :migrate_data => true
    })
  end

  def down
    Material.drop_translation_table! :migrate_data => true
  end
end
