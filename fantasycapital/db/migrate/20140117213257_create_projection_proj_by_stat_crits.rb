class CreateProjectionProjByStatCrits < ActiveRecord::Migration
  def change
    create_table :projection_proj_by_stat_crits do |t|
      t.references :projection_by_stat, index: true
      t.decimal :fp
      t.decimal :weighted_fp
      t.string :criteria

      t.timestamps
    end
    add_index :projection_proj_by_stat_crits, [:projection_by_stat_id, :criteria], unique: true, name: "i_projection_proj_by_stat_crits"
  end
end
