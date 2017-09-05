class RenameCategoryIdToGoodCategoryId < ActiveRecord::Migration
  def change
    rename_column :category_goods, :category_id, :good_category_id
  end
end
