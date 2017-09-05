class AddNameToDesigners < ActiveRecord::Migration
  def change
    add_column :designers, :name, :string
    remove_column :designer_translations, :name, :string
  end
end
