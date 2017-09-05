class CreateSettings < ActiveRecord::Migration
  def change
    create_table :settings do |t|
      t.string :key, null:false
      t.text :value

      t.timestamps
    end
  end
end
