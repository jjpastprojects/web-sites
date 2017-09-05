class AddMenuItemToMenuItems < ActiveRecord::Migration
  def change
    add_reference :menu_items, :menu_item, index: true
  end
end
