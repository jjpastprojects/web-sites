class CreateCategoryGoods < ActiveRecord::Migration
  def change
    create_table :category_goods do |t|
      t.references :category, index: true
      t.references :good, index: true

      t.timestamps
    end
  end
end
