class CreateMediaFiles < ActiveRecord::Migration
  def change
    create_table :media_files do |t|
      t.string :type
      t.references :parent, index: true
      t.references :good, index: true

      t.timestamps
    end
  end
end
