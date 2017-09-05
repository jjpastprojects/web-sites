
namespace :ops do
  desc "Operations tasks that Fantasy Capital admins might need to perform on the system"

  desc "Recalc player realtime fantasy points"
  task recalc_fp: [:environment] do
    # a player's fantasy points for a game are stored in the playerrealtimestats table together
    # with his other stats. If we have a mistake in our calcluations, we might have to update
    # them.

    #score = PlayerRealTimeScore.where(player: player, name: "fp",
    #                                  game_score:game_score).first_or_initialize
    #score.value = cal.weighted_fp { |stat_name, weight| stats[stat_name].to_f }
    #score.save!
    #changed_players.add(player)
    # BUGBUG: this needs to be finished.
  end

  task resolve_games: [:environment] do
    puts "Rake task: ops:resolve_games running"

    # if our realtime process stops for some reason, games may remain unresolved in the DB
    # (e.g. GameScore's "status" field may not have latest data). This tasks goes through any
    # unclosed games and tries to get an update from the SportsData API for them, to clean them up.

    games = GameScore.not_closed
    puts "#{games.count} games not currently closed. Checking with SportsData API..."
    games.each do |game|
      puts "#{game.id} #{game.playdate} #{game.away_team.name}@#{game.home_team.name} #{game.status}"

      game_src = SportsdataClient::Sports::NBA.full_game_stats(game.ext_game_id).result['game']
      if !game_src
        puts "Skipping... no data!"
        next
      end
      if game.record_sportsdata(game_src)
        puts "Game changed"
      else
        puts "No change"
      end
    end
  end

end
