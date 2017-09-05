class AddVimeoToGoods < ActiveRecord::Migration
  def change
    add_column :goods, :vimeo, :text
  end
end
