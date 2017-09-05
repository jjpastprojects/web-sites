class CreateDwgs < ActiveRecord::Migration
  def change
    create_table :dwgs do |t|
      t.references  :good
      t.string   :src
      t.integer  :size
      t.integer  :weight

      t.timestamps
    end
  end
end
