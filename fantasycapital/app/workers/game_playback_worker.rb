class GamePlaybackWorker
  # wrap around the rake task that injects play updates from an evening's games.
  @queue = :playback
  def self.perform(entry_id)
    puts "Starting game playback task for entry #{entry_id}"
    @entry = Entry.find(entry_id)
    @entry.contest.start!

    Rake::Task["realtime:games_playback"].invoke
    @entry.contest.end!
    puts "Done with game playback task"

  rescue Resque::TermException
    puts "Uh oh, worker failed!"
  end
end
