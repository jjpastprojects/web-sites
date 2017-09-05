class CreateVariants < ActiveRecord::Migration
  def change
    create_table :variants do |t|
      t.references :good, index: true

      t.timestamps
    end
  end
end
