class ChangeProjectionPlayerModel < ActiveRecord::Migration
  def change
    remove_column :projection_players, :ext_player_id, :string
    rename_column :projection_players, :player_name, :name
    add_column :projection_players, :is_current, :boolean
    add_column :projection_players, :stats_player_id, :integer
    add_column :projection_players, :position, :string
    add_index :projection_players, :stats_player_id
  end
end
