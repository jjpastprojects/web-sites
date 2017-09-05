class ChangeClockInGameScoreToInteger < ActiveRecord::Migration
  def change
    change_column :game_scores, :clock,
      'integer USING CAST(clock AS integer)'
  end
end
