class GoodsDropLogo < ActiveRecord::Migration
  def change
    remove_column :goods, :logo
  end
end
