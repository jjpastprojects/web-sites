class TranslatePages < ActiveRecord::Migration
  def up
    remove_column :pages, :title
    remove_column :pages, :heading
    remove_column :pages, :keywords
    remove_column :pages, :description
    remove_column :pages, :content

    Page.create_translation_table!({
      :title => :string,
      :heading => :string,
      :keywords => :text,
      :description => :text,
      :content => :text
    }, {
      :migrate_data => true
    })
  end

  def down
    Page.drop_translation_table! :migrate_data => true
  end
end
