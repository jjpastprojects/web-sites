class CreateProjectionProjectionByStats < ActiveRecord::Migration
  def change
    create_table :projection_projection_by_stats do |t|
      t.string :stat_name
      t.decimal :fp
      t.decimal :weighted_fp
      t.references :projection, index: true

      t.timestamps
    end
    add_index :projection_projection_by_stats, [:projection_id, :stat_name], unique: true, name: "projection_by_stat_projection_and_stat_name"
  end
end
