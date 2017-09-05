class CreateDesignItems < ActiveRecord::Migration
  def change
    create_table :design_items do |t|
      t.string :name, null: false
      t.references :designer, null: false

      t.timestamps
    end
  end
end
