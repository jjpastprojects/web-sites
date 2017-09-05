class CreateLanguages < ActiveRecord::Migration
  def change
    create_table :languages do |t|
      t.boolean :is_default
      t.string :name, null:false
      t.string :native, null:false
      t.string :title
      t.string :slug

      t.timestamps
    end
  end
end
