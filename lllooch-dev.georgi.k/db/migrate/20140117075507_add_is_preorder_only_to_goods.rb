class AddIsPreorderOnlyToGoods < ActiveRecord::Migration
  def change
    add_column :goods, :is_preorder_only, :boolean, null: false, default: false
  end
end
