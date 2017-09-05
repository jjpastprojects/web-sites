class DropTempletIdFromPages < ActiveRecord::Migration
  def change
    remove_column :pages, :templet_id
  end
end
