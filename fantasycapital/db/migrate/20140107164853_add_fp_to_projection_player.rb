class AddFpToProjectionPlayer < ActiveRecord::Migration
  def change
    add_column :projection_stats, :fp, :decimal
  end
end
