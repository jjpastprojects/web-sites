class AddLocaleToPostComments < ActiveRecord::Migration
  def change
    add_column :post_comments, :locale, :string
  end
end
