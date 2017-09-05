class ProjectionsController < ApplicationController
  before_action :set_time_range
  before_action :get_stats_class
  # GET /projections/(NBA|MLB)
  def index
    sport_name = params[:sport_name]
    @statscls = Projection::Stat.class_for_sport(sport_name)
    raise ActionController::RoutingError.new('Not Found') if @statscls.nil?

    @projections = Projection::Projection
                    .includes(:player,:projection_by_stats,
                              :scheduled_game => [:home_team, :away_team])
                    .where('projection_scheduled_games.start_date' => @time_range,
                           'projection_scheduled_games.sport' => sport_name)

  end

  # GET /projections/with_stats/(NBA|MLB)
  def with_stats
    index

    @stats = @statscls.stats_allowed.keys - ["minutes"]

  end
 
  # GET /projections/stats_by_game/(NBA|MLB)
  def stats_by_game
    @games_played = Projection::GamePlayed
                      .includes(:player, :game)
                      .where( player_id: params['player_id'],
                              'projection_games.sport' => sport_name)
  end

  private
  def get_stats_class
    sport_name = params[:sport_name]
    statscls = Projection::Stat.class_for_sport(sport_name)
    raise ActionController::RoutingError.new('Not Found') if statscls.nil?
  end

  def set_time_range
    if params[:date].present?
      start = Time.parse(params[:date] + " 00:00:00-05:00")
    else
      start = Time.now.in_time_zone("EST").beginning_of_day
    end
    @time_range = start..(start+1.day)
  end
end
