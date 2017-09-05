class AddWeightToVariants < ActiveRecord::Migration
  def change
    add_column :variants, :weight, :integer
  end
end
