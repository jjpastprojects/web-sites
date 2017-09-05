class CreatePages < ActiveRecord::Migration
  def change
    create_table :pages do |t|
      t.string :name, null:false
      t.references :templet, index: true
      t.string :title
      t.string :heading
      t.text :keywords
      t.text :description
      t.text :content

      t.timestamps
    end
  end
end
