class CreateProjectionProjections < ActiveRecord::Migration
  def change
    create_table :projection_projections do |t|
      t.references :scheduled_game, index: true
      t.references :player, index: true
      t.decimal :fp

      t.timestamps
    end
  end
end
