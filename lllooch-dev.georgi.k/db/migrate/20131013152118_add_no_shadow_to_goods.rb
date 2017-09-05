class AddNoShadowToGoods < ActiveRecord::Migration
  def change
    add_column :goods, :no_shadow, :boolean
  end
end
