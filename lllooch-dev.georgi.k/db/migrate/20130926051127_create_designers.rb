class CreateDesigners < ActiveRecord::Migration
  def change
    create_table :designers do |t|
      t.string :name, null:false
      t.string :title
      t.string :heading
      t.text :keywords
      t.text :description

      t.timestamps
    end
  end
end
