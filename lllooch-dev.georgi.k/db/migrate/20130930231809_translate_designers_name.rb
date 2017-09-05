class TranslateDesignersName < ActiveRecord::Migration
  def up
    remove_column :designers, :name
    add_column :designer_translations, :name, :string
  end

  def down
    add_column :designers, :name, :string, null: false
    remove_column :designer_translations, :name, :string
  end
end
