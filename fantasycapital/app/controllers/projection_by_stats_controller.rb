class ProjectionByStatsController < ApplicationController
  before_action :set_projection

  # GET /projection_by_stats
  def index
    @projection_by_stats = @projection.projection_by_stats
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def set_projection
      @projection = Projection::Projection.includes(:projection_by_stats).find(params[:projection_id])
    end

end
