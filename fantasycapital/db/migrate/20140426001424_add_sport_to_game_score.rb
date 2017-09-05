class AddSportToGameScore < ActiveRecord::Migration
  def change
    add_column :game_scores, :sport, :string, default: "NBA"
  end
end
