class TranslateNameInDesigners < ActiveRecord::Migration
  def up
    add_column :designer_translations, :name, :string
    remove_column :designers, :name
  end

  def down
    add_column :designers, :name, :string, null: false
    remove_column :designer_translations, :name, :string
  end
end
