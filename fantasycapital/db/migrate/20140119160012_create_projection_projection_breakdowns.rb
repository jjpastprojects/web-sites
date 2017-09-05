class CreateProjectionProjectionBreakdowns < ActiveRecord::Migration
  def change
    create_table :projection_projection_breakdowns do |t|
      t.references :proj_by_stat_crit, index: true
      t.references :stat, index: true

      t.timestamps
    end
  end
end
