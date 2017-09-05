class CreateCategories < ActiveRecord::Migration
  def change
    create_table :categories do |t|
      t.references :parent, index: true
      t.string :type, null:false
      t.string :name, null:false
      t.string :title
      t.string :heading
      t.text :keywords
      t.text :description

      t.timestamps
    end
  end
end
