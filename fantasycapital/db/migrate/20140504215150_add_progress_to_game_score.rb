class AddProgressToGameScore < ActiveRecord::Migration
  def change
    add_column :game_scores, :progress, :integer, default: 0
    add_column :game_scores, :gamelength, :integer
    remove_column :game_scores, :clock, :integer
    remove_column :game_scores, :period, :integer
  end
end
