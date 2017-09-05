class CreateEntries < ActiveRecord::Migration
  def change
    create_table :entries do |t|
      t.references :user, index: true
      t.references :lineup, index: true
      t.references :player, index: true
      t.string :sport

      t.timestamps
    end
  end
end
