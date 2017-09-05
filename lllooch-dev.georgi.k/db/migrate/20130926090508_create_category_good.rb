class CreateCategoryGood < ActiveRecord::Migration
  def change
    create_table :categories_goods do |t|
      t.belongs_to :good_category
      t.belongs_to :good
    end
  end
end
