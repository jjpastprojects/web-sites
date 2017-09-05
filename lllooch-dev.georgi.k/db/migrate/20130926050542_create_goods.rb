class CreateGoods < ActiveRecord::Migration
  def change
    create_table :goods do |t|
      t.string :name, null:false
      t.decimal :price
      t.string :logo, null:false
      t.string :title
      t.string :heading
      t.text :keywords
      t.text :description

      t.timestamps
    end
  end
end
