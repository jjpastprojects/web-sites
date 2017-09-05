class FixColumnsOfPlayerStatForNewRequirement < ActiveRecord::Migration
  def change
    rename_column :player_stats, :index_name, :stat_name
    rename_column :player_stats, :index_value, :stat_value
    add_column :player_stats, :dimension, :string
    add_column :player_stats, :time_span, :string
  end
end
