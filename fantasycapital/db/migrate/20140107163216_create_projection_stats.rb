class CreateProjectionStats < ActiveRecord::Migration
  def change
    create_table :projection_stats do |t|
      t.string :stat_name
      t.decimal :stat_value
      t.references :player, index: true
      t.references :game, index: true

      t.timestamps
    end
  end
end
