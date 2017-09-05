class AddMaterialNameToVariants < ActiveRecord::Migration
  def change
    change_table :variant_translations do |t|
      t.string :material_name
    end
  end
end
