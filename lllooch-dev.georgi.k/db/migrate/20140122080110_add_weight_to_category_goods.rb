class AddWeightToCategoryGoods < ActiveRecord::Migration
  def change
    add_column :category_goods, :weight, :integer, null: false, default: 9999
  end
end
