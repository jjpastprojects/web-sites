require 'csv'
require "#{Rails.root}/app/helpers/projection_by_stats_helper"
include ProjectionByStatsHelper
require 'action_view'
include ActionView::Helpers::NumberHelper

PROJECTION_SPORTS = Rails.configuration.sports.dup


namespace :projection do

  desc "Fetch data from external source (SportsData)" 
  task fetch_stats: :environment do
    PROJECTION_SPORTS.each do |sport_name, sport|

      Rails.logger.info "Fetching and populating Teams from SportsData"
      teams_from_sportsdata = sport[:api_client].teams
      teams = Projection::Team.refresh_all teams_from_sportsdata

      Rails.logger.info "Fetching and populating Players from SportsData"

      teams.each do |team|
        team.players.update_all(is_current: false)
      end
      ext_team_ids = teams.map do |team| team[:ext_team_id] end
      teams_array = sport[:api_client].players(ext_team_ids)
      Projection::Player.refresh teams_array

      Rails.logger.info "Fetching and populating Games from SportsData"

      # projection cutoff can be set by env variable to help with db 'seeding'. That is, when a new DB is
      # set up for the first time, we might need to record stats farther back than the default
      # of 10 days. Otherwise we may not have enough data to properly compute fantasy points.
      cutoff = ENV['PROJECTION_DAYS'] || "10"
      gamelist = sport[:api_client].all_season_games
      recent_games = Projection::Game.refresh_all(sport_name.to_s, gamelist, Time.now - cutoff.to_i.days)
      Rails.logger.info "Populated #{recent_games.count} games"

      Rails.logger.info "Fetching and populating Player stats from SportsData for #{recent_games.count} games"
      recent_games.each do |recent_game|
        game_stats = sport[:api_client].game_stats(recent_game.ext_game_id)
        recent_game.refresh_stats(game_stats, sport_name)
      end

      Rails.logger.info "Fetching and populating scheduled games from SportsData"
      Projection::ScheduledGame.refresh_all(sport_name, sport[:api_client].games_scheduled)
    end
    Rails.logger.info "Done with projection:fetch_stats task"
  end

  desc "Project Fantasy Points"
  task fp: [:environment] do
    Rails.logger.info "Calculating FP..."
    Projection::ScheduledGame.games_on.each do |scheduled_game|
      # enqueue tasks for Resque if we're in production, otherwise run them manually.
      if Rails.env.production? || Rails.env.staging?
        Rails.logger.info "Enqueuing FP Calculation for game #{scheduled_game.id}"
        Resque.enqueue(FPCalculationWorker, scheduled_game.id)
      else
        Rails.logger.info "Running FP Calculation for game #{scheduled_game.id} directly (non-production)"
        FPCalculationWorker.raw_perform scheduled_game.id
      end

    end
  end

  desc "Send notification email"
  task notif: [:environment] do
    today = Time.now.in_time_zone("EST").strftime("%Y-%m-%d")
    body = PROJECTION_SPORTS.map do |sport_name, sport|
      "<h3><a href='https://stage.fantasycapital.com/projections/with_stats/#{sport_name}" +
      "?date=#{today}'>#{sport_name} Projection #{today}</h3><p>"
    end

    Pony.mail(
      :to => Rails.configuration.projection_notif_email,
      :cc => "techalerts@fantasycapital.com",
      :from => Rails.configuration.projection_notif_email, 
      :subject => "Projection #{today}",
      :html_body => body)
  end

  desc "Generates report that compares projection and actual"
  task review: [:environment] do
    PROJECTION_SPORTS.each do |sport_name, sport|

      stat_names = Projection::Stat.class_for_sport(sport_name).stats_allowed.keys
      stat_names -= ["minutes", "personal_fouls", "fp"]

      today = Time.now.in_time_zone("EST").beginning_of_day
      time_range = (today-3.day)..today
      projections = Projection::Projection
                      .includes(:player, :projection_by_stats, :scheduled_game)
                      .where('projection_scheduled_games.start_date' => time_range,
                             'projection_scheduled_games.sport' => sport_name.to_s)

      filename = "#{Rails.root}/tmp/review-#{sport_name}-#{today.strftime('%Y-%m-%d')}.csv"
      CSV.open(filename, "w") do |csv|
        csv << ["Player", "Game", "fp(projection)", "fp(actual)"]
                  .concat( stat_names.inject([]) {|a, s|
                      a << "#{s}(projection)"; a << "#{s}(actual)"
                  })

        projections.each do |proj|
          player = proj.player
          game = Projection::Game.where(ext_game_id: proj.scheduled_game.ext_game_id,
                                        team: player.team).first
          next if game.nil?

          actual_fp = Projection::Stat.where(game: game, player: player, stat_name: "fp")
                        .first.try(:stat_value) || 0.0
          line = [proj.player.name, proj.scheduled_game.start_date.in_time_zone('EST'), "%.2f" % (proj.fp || 0.0), "%0.2f" % actual_fp]
          stat_names.each do |s|
            line << "%.3f" % (stat_of(proj, s).try(:fp) || 0.0)
            actual = Projection::Stat.where(game: game, player: player, stat_name: s).first
            line << "%.2f" % (actual ? actual.stat_value : 0.0)
          end
          csv << line
        end
      end

      Pony.mail(
        :to => Rails.configuration.projection_notif_email,
        :cc => "techalerts@fantasycapital.com",
        :from => Rails.configuration.projection_notif_email,
        :subject => "Review #{sport_name} #{today}",
        :html_body => "<h3>#{today}</h3>",
        :attachments => {"review-#{today.strftime('%Y-%m-%d')}.csv" => File.read(filename)}
      )
    end

  end

  desc "Purge projection database"
  task purge: :environment do
    input = ''
    STDOUT.puts "This will delete all data in projection tables! Are you sure (y/N)?"
    input = STDIN.gets.chomp
    if input.downcase == "y"
      Projection::ProjectionBreakdown.delete_all
      Projection::ProjByStatCrit.delete_all
      Projection::ProjectionByStat.delete_all
      Projection::Projection.delete_all
      Projection::Stat.delete_all
      Projection::GamePlayed.delete_all
      Projection::Game.delete_all
      Projection::ScheduledGame.delete_all
      Projection::Team.delete_all
      Projection::Player.delete_all
    end

  end
end

desc "Run all tasks needed to build project"
task projection: [:environment, "projection:fetch_stats", "projection:fp", "projection:notif", "projection:review"]
