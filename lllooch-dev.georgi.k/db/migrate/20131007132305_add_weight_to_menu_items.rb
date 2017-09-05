class AddWeightToMenuItems < ActiveRecord::Migration
  def change
    add_column :menu_items, :weight, :integer, null: false, default: 0
  end
end
