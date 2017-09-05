class CreateBlogColors < ActiveRecord::Migration
  def change
    create_table :blog_colors do |t|
      t.string :name
      t.string :color

      t.timestamps
    end
  end
end
