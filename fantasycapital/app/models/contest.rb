# == Schema Information
#
# Table name: contests
#
#  id            :integer          not null, primary key
#  title         :string(255)
#  sport         :string(255)
#  contest_type  :string(255)
#  entry_fee     :decimal(, )
#  contest_start :datetime
#  created_at    :datetime
#  updated_at    :datetime
#  max_entries   :integer
#  entries_count :integer          default(0)
#  contestdate   :date
#  rake          :float            default(0.1)
#


class Contest < ActiveRecord::Base
  validates :contestdate, presence: true

  has_many :entries, inverse_of: :contest
  has_many :player_contests, inverse_of: :contest
  has_many :eligible_players, source: :player, through: :player_contests

  has_many :lineups, through: :entries
  has_many :users, through: :lineups

  #TODO: placeholder for testing the views
  def salary_cap
    65000
  end

  def start_at
    # return start of contest. this is simply the start time fo the earliest game of the contest date.
    GameScore.earliest_start(self.contestdate)
  end

  def started?
    # return if this contest has started. It's based on scheduled start times which should be
    # conservative. This will block new entries in a contest. Maybe we'll also have to check game
    # statuses in case a game starts early?

    self.start_at < Time.now
  end

  def prizepool
    # total prize pool available in contest, with rake removed
    (self.max_entries*self.entry_fee) * (1.0-self.rake)
  end

  def has_final_score_and_pos?
    self.entries.count > 0 and self.entries.missing_final_score_or_pos.count == 0
  end

  def has_final_score?
    self.entries.count > 0 and self.entries.missing_final_score.count == 0
  end

  def current_pos(entry)
    # get the current position of an entry in the contest. This is meant to be used during a live
    # game. It's kind of expensive to compute.

    myscore = entry.current_fantasypoints
    c = self.entries.to_a.count do |e|
      e.current_fantasypoints > myscore
    end
    return c + 1
  end

  def record_final_outcome!
    # record contest outcome, meaning entry positions. return nil if any entries aren't final yet.
    return nil if !has_final_score?
    entries_ordered = self.entries.order(final_score: :desc)
    lastscore = -9999
    currpos = -99
    entries_ordered.each_with_index { |entry, idx |
      # record scores, making tied values have the same position
      currpos=idx unless entry.final_score == lastscore
      lastscore = entry.final_score
      entry.update(final_pos: currpos+1)
    }
    # resolve financial transactions as a result of this contest ending.
    TransactionService::contest_end(self)

    return entries_ordered
  end

  def accurate_state
    # return this contest's state, accurately. This is inexpensive for contests in past or future,
    # but expensive for ones where we have to dig through the entries. There are only three
    # states here -- :closed, :in_future, or :live

    games = GameScore.where(playdate: self.contestdate)
    # shortcut -- if all games from the contest are closed, then the contest is closed.
    return :closed if games.not_closed.count == 0

    # shortcut -- if all games from the contest are in future, then the contest is in future.
    #   multiple levels of negatives here b/c of the way we identify status in games.
    return :in_future if games.not_in_future.count == 0

    # don't know. gotta find it by digging through entries (so we can mark 'closed' the moment
    # all entries in a contest finish
    states = self.entries.map { |entry| entry.accurate_state }
    return :live if states.include?(:live)
    return :closed if !states.include?(:in_future)
    return :in_future
  end

  def filled?
    max_entries.nil? ? false : entries.count >= max_entries.to_i
  end

  def eligible_for?(user, user_entries = nil)
    # make sure user didn't enter contest more than the MAX # of times. They can enter a tournament
    #  5 times; other contest types only once.
    if user.nil?
      true
    else

      # prefetched entries list fixes n^2 sql calls
      user_entries = user.entries unless user_entries

      max_entries_per_user = (contest_type.downcase == "tournament") ? 5 : 1
      f = user_entries.select {|e| e.contest == self}.count < max_entries_per_user
      f
    end
  end

  def enter(lineup)
    # enter a contest with the given lineup, and return the new Entry
    raise "#{lineup.user} maximized the number of entries" unless eligible_for? lineup.user
    raise "Maximum entries reached" if filled?
    dup.save! if entries.count == max_entries - 1
    entry = nil 
    # create the entry, and make the financial transaction as appropriate.
    ActiveRecord::Base.transaction do
      entry = entries.create!(lineup: lineup)
      TransactionService.contest_entry(lineup.user, entry)
    end
    entry
  end

  def winnings
    return Winnings.new(self).compute
  end

  def as_json(options = { })
    # add computed parameters for json serialization (for sending to browser)
    h = super(options)
    #h[:pretty_contest_name]   = self.pretty_contest_name
    h
  end

  class << self

    def in_range(user=nil, start_date, end_date)
      # show contests for dates (array or single). This might show some that are already live.
      where("contestdate between (?) and (?)", start_date, end_date).order(
              contestdate: :asc, contest_type: :asc, entry_fee: :asc)
    end

    def eligible(user=nil, start_time)
      # return if a user is eligible for a set of contests that comes in as a query.
      user_entries = user ? user.entries.includes(:contest) : nil
      select do |c|
        (! c.filled?) && c.eligible_for?(user, user_entries) && (c.start_at > start_time)
      end
    end

    def for_sport(sport)
      where sport: sport
    end

    def sport_names
      group(:sport).pluck(:sport)
    end


  end

end
