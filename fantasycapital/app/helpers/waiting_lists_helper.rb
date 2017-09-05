module WaitingListsHelper
  def refer_link_for_current_user
    invite_waiting_lists_url(token: curent_user.invitation_token)
  end
end
