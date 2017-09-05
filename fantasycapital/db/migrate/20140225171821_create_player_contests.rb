class CreatePlayerContests < ActiveRecord::Migration
  def change
    create_table :player_contests do |t|
      t.references :player, index: true
      t.references :contest, index: true

      t.timestamps
    end
  end
end
