class AddWeightToGoods < ActiveRecord::Migration
  def change
    add_column :goods, :weight, :integer
  end
end
