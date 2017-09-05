class DropPostCategoryFromPosts < ActiveRecord::Migration
  def change
    remove_column :posts, :post_category_id
  end
end
