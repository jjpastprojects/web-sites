class ChangeExtIdForPlayer < ActiveRecord::Migration
  def change
    remove_column :players, :stats_id, :integer
    add_column :players, :ext_player_id, :string
  end
end
