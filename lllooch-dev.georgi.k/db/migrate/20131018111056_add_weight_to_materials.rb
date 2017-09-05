class AddWeightToMaterials < ActiveRecord::Migration
  def change
    add_column :materials, :weight, :integer
  end
end
