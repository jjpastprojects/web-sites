class CreateProjectionTeams < ActiveRecord::Migration
  def change
    create_table :projection_teams do |t|
      t.string :name

      t.timestamps
    end
  end
end
