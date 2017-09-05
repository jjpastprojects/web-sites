class CreatePostComments < ActiveRecord::Migration
  def change
    create_table :post_comments do |t|
      t.boolean :is_safe
      t.string :author
      t.string :email
      t.text :content

      t.timestamps
    end
  end
end
