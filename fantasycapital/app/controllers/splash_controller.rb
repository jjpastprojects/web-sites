class SplashController < ApplicationController
  skip_before_action :restrict_to_splash_page
  layout "splash"

  def index
    @waiting_list = WaitingList.new
  end
end
