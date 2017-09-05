class WaitingListsController < ApplicationController
  skip_before_action :restrict_to_splash_page
  layout 'splash'

  # GET /waiting_lists/new
  def new
    @waiting_list = WaitingList.new
  end

  def invite
    respond_to do |format|
      format.html { render layout: 'application' }
    end
  end

  # POST /waiting_lists/inviting

  def inviting
    InviteWorker.perform_async(params["invite"], current_user.id)
    redirect_to root_path
  end

  # POST /waiting_lists
  def create
    @waiting_list = WaitingList.new(waiting_list_params)
    if @waiting_list.save
      redirect_to @waiting_list, notice: 'Waiting list was successfully created.'
    else
      render action: 'new'
    end
  end

  def show
    @waiting_list = WaitingList.find_by_invitation_token params[:id]
  end

  private

  # Only allow a trusted parameter "white list" through.
  def waiting_list_params
    params.require(:waiting_list).permit(:email, :name, :invited_by_token)
  end

  def set_layout
    action_name == 'refer' ? "splash" : 'application'
  end
end
