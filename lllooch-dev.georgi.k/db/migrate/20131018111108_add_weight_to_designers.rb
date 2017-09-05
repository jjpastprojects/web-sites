class AddWeightToDesigners < ActiveRecord::Migration
  def change
    add_column :designers, :weight, :integer, null: false, default: 0
  end
end
