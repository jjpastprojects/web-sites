class ContestsController < ApplicationController
  before_action :set_contest, only: [:show, :edit, :update, :destroy]

  # GET /contests
  # GET /contests.json
  def index
    @contests = current_user.contests
  end

  # This is our homepage (/)
  def browse
    todaydate = Time.now.in_time_zone("US/Pacific").to_date
    now = Time.now

    # grab upcoming contests that user can enter.
    @contests = Contest.in_range(current_user, todaydate, todaydate+1).eligible(current_user, now)
    
    # for realtime push testing: show fake contests only when user is admin
    if current_user.try(:admin)
      @contests += Contest.where("contest_start > ?", Date.strptime("2030","%Y"))
    end

  end

  # GET /contests/1
  # GET /contests/1.json
  def show
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def set_contest
      @contest = Contest.find(params[:id])
    end

    # Never trust parameters from the scary internet, only allow the white list through.
    def contest_params
      params[:contest]
    end
end
