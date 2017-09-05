class UsersController < ApplicationController
  def leadboard
  end

  def signin_popup
  	@user = User.new
    render layout: false
  end

  def subregion_options
  	render partial: 'subregion_select'
  end
end
