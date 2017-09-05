class AddMaterialTypeTextToGoods < ActiveRecord::Migration
  def change
    change_table :good_translations do |t|
      t.string :material_type_text
    end
  end
end
