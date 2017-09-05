class CreatePageTypes < ActiveRecord::Migration
  def change
    create_table :page_types do |t|
      t.string :name
      t.string :method

      t.timestamps
    end
  end
end
