class Winnings

  attr_reader :winners

  def initialize contest
    @winners = []
    @contest = contest
  end

  def compute
    return [] unless @contest.has_final_score_and_pos?
    case @contest.contest_type
      when "H2H"
        compute_h2h
      when "Tournament"
        compute_tournament
      when "50/50"
        compute_5050
      else
        raise RuntimeError, "Unknown contest type in winnings computation"
     end
  end

  def compute_h2h
    # One H2H (Head2Head)  allows 10 entrants. Entrants are randomly matched.
    #  Winner of each of the 5 1v1 contests doubles their money minus rake
    puts "HEAD-2-HEAD WIN COMPUTATION NOT IMPLEMENTED"
    entries = @contest.entries.order(final_pos: :asc)
    []
  end

  def compute_tournament
    # One tournament allows 100 entrants. Multiple entries allowed. Winner gets the pot minus rake
    # Ties divide up the prize.
    winningentries = @contest.entries.where(final_pos: 1)
    prize = 1.0 / winningentries.count
    winningentries.map do | entry |
      {entry:entry, prize_fraction:prize}
    end
  end

  def compute_5050
    # 50/50 contest allows an even number of entrants. Top half (50%) double their money minus rake
    retval = []
    entrycount = @contest.entries.count
    highestwinnerpos = entrycount / 2
    if entrycount.odd?
      raise "Can't handle odd # of entries in contest, contestID=#{contest.id}, #{entrycount} entries"
    end
    # winnings per slot (e.g. with 10 entries, there are 5 winning slots, each slot gets 0.2)
    slot_winnings = 1.0 / highestwinnerpos

    entries = @contest.entries.where('final_pos <= ?', highestwinnerpos).order(final_pos: :asc)

    # If there are more than 'highestwinnerpos' winners, that means there was a tie in the last positions.
    # The folks who tied on the back end share the last winning place winnings... everyone else gets
    # the normal winnings.

    finalpos = entries[-1].final_pos
    # divide the list into entries with the same position as the last element, and those that don't.
    (last_entries,not_last_entries) = entries.partition { |entry| entry.final_pos == finalpos}

    slots_for_last_entries = highestwinnerpos - not_last_entries.length
    prize_for_last_entrant = (slots_for_last_entries * slot_winnings / last_entries.length).round(4)
    not_last_entries.each do |entry|
      retval << {entry:entry, prize_fraction:slot_winnings}
    end

    last_entries.each do |entry|
      retval << {entry:entry, prize_fraction:prize_for_last_entrant}
    end
    retval
  end

end