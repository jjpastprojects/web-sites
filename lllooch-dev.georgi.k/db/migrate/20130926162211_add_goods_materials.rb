class AddGoodsMaterials < ActiveRecord::Migration
  def change
    create_table :goods_materials do |t|
      t.belongs_to :good
      t.belongs_to :material
    end
  end
end
