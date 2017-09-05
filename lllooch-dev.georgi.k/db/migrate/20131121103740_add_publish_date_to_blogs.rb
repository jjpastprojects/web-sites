class AddPublishDateToBlogs < ActiveRecord::Migration
  def change
    change_table :posts do |t|
      t.date :publish
    end
  end
end
