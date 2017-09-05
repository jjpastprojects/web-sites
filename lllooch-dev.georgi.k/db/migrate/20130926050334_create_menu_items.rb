class CreateMenuItems < ActiveRecord::Migration
  def change
    create_table :menu_items do |t|
      t.references :page, index: true
      t.references :menu, index: true, null: false
      t.string :name, null:false
      t.string :title
      t.string :url

      t.timestamps
    end
  end
end
