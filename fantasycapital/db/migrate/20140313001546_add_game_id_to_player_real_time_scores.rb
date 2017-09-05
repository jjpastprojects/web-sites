class AddGameIdToPlayerRealTimeScores < ActiveRecord::Migration
  def change
    add_reference :player_real_time_scores, :game_score, index: true
  end
end
