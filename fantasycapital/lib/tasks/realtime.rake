

REALTIME_SPORTS = Rails.configuration.sports.dup

namespace :realtime do

  desc "Check if realtime-data task should be started. This task should be run from heroku scheduler ~once per hour. "
  task check_start_realtime: :environment do
    now = Time.now
    today = now.in_time_zone("US/Pacific").to_date

    puts "Checking whether to start realtime service for #{today}"
    games = GameScore.in_range(today, today).not_closed.order(scheduledstart: :asc)
    if games.count.zero?
      puts "... no unclosed games today. Returning"
    else
      firststart = games.first.scheduledstart
      puts "First game scheduled start = #{firststart}"
      puts "Now is #{now}"
      # if the first game starts within a few hours, turn on RTdata. Note this will fire even when RTdata is already
      # running, but that's harmless even in corner cases.
      if  now + 3.hours > firststart
        puts "Starting / ensuring RTdata is running..."
        heroku = Heroku::API.new(:api_key => ENV['HEROKU_API_KEY'])
        heroku.post_ps_scale(Rails.configuration.app_name, 'rtdata', 1)
      end
    end
  end

  desc "Run realtime game stats until games are over today. This task will be launched daily by check_start_realtime "
  task games: :environment do
    # Monitor all live games from one process and thread to economize on DB connections.
    today = Time.now.in_time_zone("US/Pacific").to_date
    puts "Starting realtime game task for #{today}"
    Signal.trap("TERM") do
      puts "Realtime function received Sigterm... Exiting."
      exit
    end

    # manage a list of games for today that aren't complete yet.


    # update all games that are in progress every 20 seconds, while any games are in progress.
    loop do
      games = GameScore.in_range(today, today).not_closed
      break if games.length == 0
      puts "Running realtime game status for #{games.length} games for #{today}"

      # repeat polling games multiple times before checking if any games have 'closed' again.
      6.times do
        timerthread = Thread.new do
          Rails.logger.debug "Starting 20 second timer..."
          sleep 20
          Rails.logger.debug "20-second timer done."
        end

        now = Time.now

        PROJECTION_SPORTS.each { |sport_name, sport|
          # iterate through games. Delete games from the list if they've closed. Update them with new
          # API data if they are in progress.
          games_for_sport = games.where(sport:sport_name)
          game_closed_with_score = false
          players_somewhere_changed = false
          # kind of a hack -- MLB scores aren't part of the game-stats, while in NBA they are. So
          # for MLB grab daily_scores for all games once per loop, then inject them into the
          # API client. Ultimately want to encapsulate this logic into the API client.
          daily_scores = sport_name==:MLB ? sport[:api_client].daily_scores(today) : nil
          games_for_sport.each do |game|
            if game.scheduledstart - 15.minutes > now
              Rails.logger.debug "Skipping #{game.sport} game #{game.id} (in future), "
                                 "starttime= #{game.scheduledstart}"
              next
            end
            Rails.logger.debug "Updating game #{game.away_team.teamalias}@#{game.home_team.teamalias}"
            gamestate = sport[:api_client].full_game_stats(game.ext_game_id, daily_scores)
            game, a_player_changed = RealTimeDataService.new.refresh_game gamestate
            game_closed_with_score = true if game.closed? and !game.exception_ending?
            players_somewhere_changed = true if a_player_changed
          end

          # send entries to browser
          if players_somewhere_changed
            RealTimeDataService.new.refresh_entries today, sport_name
          else
            Rails.logger.debug "No players changed in any #{sport_name} games"
          end

          # if one of the games just closed, see if we can close out any contests

          if game_closed_with_score
            Rails.logger.debug "A game just closed... trying to close contests"
            RealTimeDataService.new.try_closing_contests today, sport_name
            Rails.logger.debug "Done closing contests"
          end

        }
        timerthread.join

      end
    end

    # all games for day are done - turn off the dyno.
    puts "All games done for today. Shutting off realtime worker"
    heroku = Heroku::API.new(:api_key => ENV['HEROKU_API_KEY'])
    heroku.post_ps_scale(Rails.configuration.app_name, 'rtdata', 0)

  end

  desc "capture realtime game stats and save them to files"
  task games_to_file: :environment do
    while true do
      begin
        ts = Time.now.strftime("%d-%H-%M-%S")
          Projection::ScheduledGame.games_on.each do |game|
          File.open("tmp/#{ts}__#{game.ext_game_id}.json","w") do |f|
            f.write(SportsdataClient::Sports::NBA.full_game_stats(game.ext_game_id, nil).result.to_json)
          end
        end
        sleep 150
      rescue => e
        logger.error e.message
        logger.error e.backtrace.join("\n")
      end
    end
  end

  desc "play back game stats from saved json files"
  task games_playback: :environment do
    killme=false
    Signal.trap("TERM") do
      puts "games-playback from file got SIGTERM..."
      killme=true
    end

    if !File.directory?("#{Rails.root}/db/gamefeeds")
      `cd db && tar xzvf gamefeeds.tgz`
    end

    # map captured games to real games in play, by ext_game_id

    Dir.entries( "#{Rails.root}/db/gamefeeds").select {|f| !File.directory? f}.map{|x| x[0..10]}.uniq.sort.each do |ts|
      Dir["#{Rails.root}/db/gamefeeds/#{ts}*"].each do |feed|
        puts "Sending file #{feed}"
        game_json = JSON.parse(File.open(feed).read)
        game_json = SportsdataClient::Sports::NBA.fix_full_game_stats(game_json)

        # IDs of the "fake" games in DB is "FAKE-" + real_game_id
        game_json['id'] = "FAKE-" + game_json['id']
        RealTimeDataService.new.refresh_game game_json
        break if killme
      end
      RealTimeDataService.new.refresh_entries "2050-12-31", "NBA"
      sleep 1
      break if killme
    end
    # reset all fake games status back to scheduled so that next time they will run again
    GameScore.where("ext_game_id like ?", "FAKE-%").update_all(status: "scheduled")
  end

end
