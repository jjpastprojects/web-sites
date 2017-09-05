class TranslatePosts < ActiveRecord::Migration
  def up
    remove_column :posts, :title
    remove_column :posts, :heading
    remove_column :posts, :keywords
    remove_column :posts, :description
    remove_column :posts, :content

    Post.create_translation_table!({
      :title => :string,
      :heading => :string,
      :keywords => :text,
      :description => :text,
      :content => :text
    }, {
      :migrate_data => true
    })
  end

  def down
    Post.drop_translation_table! :migrate_data => true
  end
end
