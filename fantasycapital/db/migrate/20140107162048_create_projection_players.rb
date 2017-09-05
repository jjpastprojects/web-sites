class CreateProjectionPlayers < ActiveRecord::Migration
  def change
    create_table :projection_players do |t|
      t.string :ext_player_id
      t.string :player_name

      t.timestamps
    end
  end
end
