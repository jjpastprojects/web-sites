class CreateComments < ActiveRecord::Migration
  def change
    create_table :comments do |t|
      t.references :post, index: true, null:false
      t.references :comment, index: true
      t.string :author, null:false
      t.string :email, null:false
      t.text :content

      t.timestamps
    end
  end
end
