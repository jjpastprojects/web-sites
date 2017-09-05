class CreateProjectionGamePlayeds < ActiveRecord::Migration
  def change
    create_table :projection_game_playeds do |t|
      t.references :player, index: true
      t.references :game, index: true

      t.timestamps
    end
  end
end
