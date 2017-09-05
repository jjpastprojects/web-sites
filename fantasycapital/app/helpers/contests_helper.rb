module ContestsHelper
  def contest_livein_countdown(contest)
    # TODO: rename method to contest_countdown and fix the logic
    #This is a "Countdown" column. For example, if today's first NBA game starts at 7:00pm EST and it is 1:00pm EST right now, the game would be live in 06:00:00. For games that don't start within 24hrs, we would specific the start of the game. For example, if the NFL contest doesn't start until Thurs at 7:00pm, we would like the column to read "THU 7:00pm". Please refer to draftkings.com for reference. All contest starting points are today (12/19) at 7:00pm

    time_remaining_in_seconds = contest.contest_start - DateTime.now
    Time.at(time_remaining_in_seconds).utc.strftime("%H:%M:%S")
  end



  def  contest_entry_fee(contest)
    contest.entry_fee.zero? ? 'Free' : number_to_currency(contest.entry_fee, precision: 0)
  end
end
