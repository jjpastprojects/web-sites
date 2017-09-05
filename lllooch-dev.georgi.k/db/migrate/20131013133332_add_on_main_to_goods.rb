class AddOnMainToGoods < ActiveRecord::Migration
  def change
    add_column :goods, :on_main, :boolean
  end
end
