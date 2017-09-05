class AddBgToGoods < ActiveRecord::Migration
  def change
    add_column :goods, :bg, :string
  end
end
