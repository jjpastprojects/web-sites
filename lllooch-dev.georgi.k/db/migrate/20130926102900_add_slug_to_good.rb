class AddSlugToGood < ActiveRecord::Migration
  def change
    add_column :goods, :slug, :string, null: false
  end
end
