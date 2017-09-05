class ProjectionBreakdownsController < ApplicationController
  before_action :set_projection_by_stat_and_game

  # GET /projection_by_stats
  def index
    @project_breakdowns = @projection_by_stat_and_game.projection_breakdowns
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def set_projection_by_stat_and_game
      @projection_by_stat_and_game = Projection::ProjByStatCrit.find(params[:projection_by_stat_and_game_id])
    end

end
