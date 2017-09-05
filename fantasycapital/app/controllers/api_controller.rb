class ApiController < ApplicationController
	respond_to :json

  def searchEntries
    # API called on /entries page. We might want to remove this, and just rely on backbone models
    # seeded from server.
    todaydate = Time.now.in_time_zone("US/Pacific").to_date

    liveContests = []
    upcomingContests = []
    completedContests = []

    entries_in_play = current_user.entries.in_range(todaydate-7, todaydate+7).
                        includes(:contest).includes(:lineup)

    entries_in_play.each do |entry|
      # the API has a funky format, close to a contest but not quite. Build up an element for it.
      contest = entry.contest.attributes
      contest['results_path'] = entry_path(entry)
      contest['view_path'] = entry_path(entry)
      contest['edit_path'] = edit_lineup_path(entry.lineup)

      # determine which list the entry goes on.
      state = entry.contest.accurate_state
      completedContests << contest if state == :closed
      liveContests << contest if state == :live
      upcomingContests << contest if state == :in_future
    end

    render json: {liveContests: liveContests, upcomingContests: upcomingContests,
                  completedContests: completedContests}

  end


end
