class CreateLineups < ActiveRecord::Migration
  def change
    create_table :lineups do |t|
      t.references :user, index: true
      t.references :contest, index: true

      t.timestamps
    end
  end
end
