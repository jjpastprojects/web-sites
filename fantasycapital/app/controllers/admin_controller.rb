class AdminController < ApplicationController
  before_action :require_admin!

  layout "admin"  # use admin.html.erb as base layout

  def index
    todaydate = Time.now.in_time_zone("US/Pacific").to_date

  end

  def games
    todaydate = Time.now.in_time_zone("US/Pacific").to_date

    @games = GameScore.in_range(todaydate-3, Time.new(2060,1,1))
  end

  def entries
    todaydate = Time.now.in_time_zone("US/Pacific").to_date

    @entries = Entry.in_range(todaydate-3, Time.new(2060,1,1))
  end

  def contests
    todaydate = Time.now.in_time_zone("US/Pacific").to_date
    @contests = Contest.in_range(todaydate-2, Time.new(2060,1,1))
  end

  def users
    @users = User.all
  end

  private
    def require_admin!
      # check if user has 'admin' bit set in their profile.
      redirect_to main_app.root_url unless current_user.try(:admin?)
    end

end
