class AddPostToPostComments < ActiveRecord::Migration
  def change
    add_reference :post_comments, :post, index: true
  end
end
