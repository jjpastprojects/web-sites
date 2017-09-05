class AddColorToPost < ActiveRecord::Migration
  def change
    add_column :posts, :blog_color_id, :integer, null: false
  end
end
