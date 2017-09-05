class RemoveFpFromProjectionPlayer < ActiveRecord::Migration
  def change
    remove_column :projection_players, :fp, :decimal
  end
end
