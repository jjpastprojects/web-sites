class CreatePostBlocks < ActiveRecord::Migration
  def change
    create_table :post_blocks do |t|
      t.references :post, index: true
      t.string :type
      t.timestamps
    end
  end
end
