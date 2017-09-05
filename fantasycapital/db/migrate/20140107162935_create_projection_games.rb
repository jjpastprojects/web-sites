class CreateProjectionGames < ActiveRecord::Migration
  def change
    create_table :projection_games do |t|
      t.datetime :gamedate
      t.boolean :is_home

      t.timestamps
    end
  end
end
