class RemoveDwgsTable < ActiveRecord::Migration
  def change
    drop_table :dwgs
    drop_table :dwg_translations
  end
end
