class CreatePosts < ActiveRecord::Migration
  def change
    create_table :posts do |t|
      t.references :post_category, index: true, null:false
      t.string :name, null:false
      t.string :title
      t.string :heading
      t.text :keywords
      t.text :description
      t.text :content

      t.timestamps
    end
  end
end
