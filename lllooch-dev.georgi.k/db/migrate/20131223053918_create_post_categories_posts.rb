class CreatePostCategoriesPosts < ActiveRecord::Migration
  def change
    create_table :post_categories_posts do |t|
      t.belongs_to :post_category
      t.belongs_to :post
    end

    add_index :post_categories_posts, [:post_category_id, :post_id], name: 'post_categories_posts_mn'
  end
end
