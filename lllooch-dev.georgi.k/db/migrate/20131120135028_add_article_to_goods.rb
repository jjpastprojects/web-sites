class AddArticleToGoods < ActiveRecord::Migration
  def change
    change_table :goods do |t|
      t.string :article, null: false, default: ''
    end
  end
end
