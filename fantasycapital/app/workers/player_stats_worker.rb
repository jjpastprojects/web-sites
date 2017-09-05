class PlayerStatsWorker
  @queue = :player_stats
  def self.perform(scheduled_game_id)
    StatService.new.update_player_stats Projection::ScheduledGame.find(scheduled_game_id)
  rescue Resque::TermException
    Resque.enqueue(self, scheduled_game_id)
  end
end
