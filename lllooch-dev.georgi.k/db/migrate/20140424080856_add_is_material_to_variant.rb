class AddIsMaterialToVariant < ActiveRecord::Migration
  def change
    add_column :variants, :is_material, :boolean, null: false, default: true
  end
end
