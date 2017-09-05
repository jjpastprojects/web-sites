class TranslateCategories < ActiveRecord::Migration
  def up
    remove_column :categories, :title
    remove_column :categories, :heading
    remove_column :categories, :keywords
    remove_column :categories, :description

    Category.create_translation_table!({
      :title => :string,
      :heading => :string,
      :keywords => :text,
      :description => :text
    }, {
      :migrate_data => true
    })
  end

  def down
    Category.drop_translation_table! :migrate_data => true
  end
end
