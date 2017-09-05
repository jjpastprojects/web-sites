class TranslateDesigners < ActiveRecord::Migration
  def up
    remove_column :designers, :title
    remove_column :designers, :heading
    remove_column :designers, :keywords
    remove_column :designers, :description

    Designer.create_translation_table!({
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
    Designer.drop_translation_table! :migrate_data => true
  end
end
