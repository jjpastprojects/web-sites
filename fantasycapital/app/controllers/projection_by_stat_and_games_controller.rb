class ProjectionByStatAndGamesController < ApplicationController
  before_action :set_projection_by_stat

  # GET /projection_by_stat_and_games
  def index
    @projection_by_stat_and_games = @projection_by_stat.proj_by_stat_crit
  end

  private
    def set_projection_by_stat
      @projection_by_stat = Projection::ProjectionByStat.find(params[:projection_by_stat_id])
    end
end
