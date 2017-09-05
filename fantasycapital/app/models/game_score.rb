# == Schema Information
#
# Table name: game_scores
#
#  id              :integer          not null, primary key
#  playdate        :date
#  ext_game_id     :string(255)
#  scheduledstart  :datetime
#  home_team_id    :integer
#  away_team_id    :integer
#  home_team_score :integer
#  away_team_score :integer
#  status          :string(255)
#  clock           :integer
#  period          :integer
#  created_at      :datetime
#  updated_at      :datetime
#  sport           :string(255)      default("NBA")
#

class GameScore < ActiveRecord::Base

  # existence of a scheduled start time is important - contest starts are based on it. So
  #  even if a game didn't have a fixed start time yet, we should populate it with an early time.
  #  Alternatively, we could make games without a start time become ineligible for contests,
  #  and make sure contests aren't created on days with fewer than 3 SCHEDULED games.
  validates :scheduledstart, presence: true
  validates :status, presence: true
  validates :ext_game_id, uniqueness: true
  validates :sport, presence: true
  validates :home_team, presence: true
  validates :away_team, presence: true
  validates :progress, presence: true
  validates :gamelength, presence: true

  belongs_to :home_team, :class_name => 'Team'
  belongs_to :away_team, :class_name => 'Team'

  has_many :player_real_time_scores, dependent: :destroy
  before_validation :default_values

  # set default values to remediate older database objects.
  def default_values
    if self.sport=="NBA"
      self.gamelength ||=48   # 48 minutes.
      self.progress ||= 0
    elsif self.sport=="MLB"
      self.gamelength ||=18   # 18 inning-halves.
      self.progress ||= 0
    else
      Rails.logger.error "Unknown sport #{self.sport}!"
    end

  end
  # games can have one of these status's (from the external API):
  #scheduled - The game is scheduled to occur.
  #created – The game has been created and we have begun logging information.
  #inprogress – The game is in progress.
  #halftime - The game is currently at halftime.
  #complete – The game is over, but stat validation is not complete.
  #closed – The game is over and the stats have been validated.
  #cancelled – The game has been cancelled.
  #delayed – The start of the game is currently delayed or the game has gone from in progress to delayed
  #for some reason.
  #postponed – The game has been postponed, to be made up at another day and time.
  #time-tbd – The game has been scheduled, but a time has yet to be announced.
  #unnecessary – The series game was scheduled to occur, but will not take place due to one team
  #clinching the series early.

  # status indications that aren't an exception:
  GOOD_STATUSES = ['scheduled', 'time-tbd', 'created', 'inprogress', 'halftime', 'complete',
                   'closed', 'delayed']

  UNCLOSED_STATUSES = GOOD_STATUSES.clone
  UNCLOSED_STATUSES.delete('closed')

  IN_PROGRESS_STATUSES = ['inprogress', 'halftime', 'delayed']

  IN_FUTURE_STATUSES = ['scheduled', 'time-tbd', 'created']

  def accurate_state
    # primary way to learn state of game. Same method exists on contests, games, and entries
    # with a simple return -- :closed, :in_future, or :live based on current game state.
    return :in_future if IN_FUTURE_STATUSES.include?(status)
    return :live if UNCLOSED_STATUSES.include?(status)
    return :closed
  end

  def in_future?
    IN_FUTURE_STATUSES.include?(status)
  end

  def live?
    IN_PROGRESS_STATUSES.include?(status)
  end

  def exception_ending?
    # did game finish with an exception condition? (ie no final scores?)
    !GOOD_STATUSES.include?(status)
  end
  # game is over and done, including final scores if it completed successfully
  def closed?
    !UNCLOSED_STATUSES.include?(status)
  end
  # scores are valid (ie game finished successfully and we've got final data)
  def scores_valid?
    (self.status=='closed') && !exception_ending?
  end

  def pending_final?
    (self.status=='complete')
  end

  # Amount of game left to play.
  def game_remaining
    begin
      # bit of a hack -- pre-game progress can sometimes be negative in the DB. I need to go
      #   back and address that, but later...
      gameprog = [0, self.progress].max

      if self.sport == "MLB"
        (self.gamelength - gameprog) / 2.0
      else
        (self.gamelength - gameprog)
      end

    rescue
      0    # some old NBA games don't have these fields filled out... stub it instead. this
            # can ultimately go away, b/c going forward new games validate presence of this field.
    end

  end

  # pretty-printed play state for user, ie "5 min left" or "FINAL" or "scheduled" (if scheduled)
  def pretty_play_state

    case self.accurate_state
      when :in_future
        "SCHEDULED"
      when :live
        if self.pending_final?
          "PENDING..."
        else
          if self.sport=="NBA"
            "#{game_remaining} MIN LEFT"
          elsif self.sport=="MLB"
            "#{self.progress/2} INNING"
          end
        end
      when :closed
        if self.exception_ending?
          "CANCELLED"
        else
          "FINAL"
        end
    end
  end

  def game_progress(game_src)
    # For NBA games, "progress" is # of minutes played (against a fixed amount of 48)
    if self.sport == "MLB"
      Integer(game_src['inning'])*2 + (game_src['inning_half']=='B' ? 1 : 0)
    elsif self.sport == "NBA"

      begin
        # 'clock' is a string containing "mm:ss" -- parse out the minutes
        (12 * Integer(game_src['quarter'])) - Integer(game_src['clock'].split(':')[0])
      rescue => e
        Rails.logger.error "Bad value in game_src"
        raise
      end

    else
      raise "Unknown sport #{self.sport} in GameScore.game_progress"
    end
  end

  # record game status for this game from sportsdata API (sportsdata 'game-summary' data). returns true if game changed
  def record_sportsdata (game_src)
    # get realtime stats on any game that is in progress and hasn't been resolved in our DB yet.
    # games are only resolved in our DB once they are "closed" from the external API, or if
    # some other exception (like 'postponed', 'unnecessary', 'cancelled') happens.
    return false if game_src['status'] == 'scheduled'  # game hasn't started yet - nothing to update.
    return false if closed?  # we're done with this game, no changes made.
    if !exception_ending?
      # good status
      self.progress = game_progress(game_src)
      begin
        self.home_team_score=Integer(game_src['team'][0]['points'])
        self.away_team_score=Integer(game_src['team'][1]['points'])
      rescue
        Rails.logger.error "Error recording team points"
        raise
      end

    end
    # record status at end of update so we still capture one 'closed' state.
    self.status = game_src['status']
    change = self.changed?
    save!
    return change
  end

  def as_json(options = { })
    # add computed parameters for json serialization (for sending to browser)
    h = super(options)
    h[:pretty_play_state] = self.pretty_play_state
    h[:game_remaining] = self.game_remaining
    h
  end

  class << self

    def recent_and_upcoming
      # games from up to 24 hours ago, plus future games.
      where "playdate >= ?", Time.now.in_time_zone("US/Pacific").to_date - 1
    end

    def earliest_start(day)
      # Return the earliest time of a game on a given day. returns nil if no games are scheduled
      # that day.
      where("playdate = ?", day).order(:scheduledstart).pluck(:scheduledstart)[0]
    end

    def closed
      where "status NOT in (?)", UNCLOSED_STATUSES
    end

    def not_closed
      where "status in (?)", UNCLOSED_STATUSES
    end

    def live
      where "status IN (?)", IN_PROGRESS_STATUSES
    end

    def not_in_future
      where "status NOT IN (?)", IN_FUTURE_STATUSES
    end

    def in_future
      where "status IN (?)", IN_FUTURE_STATUSES
    end

    def scheduled_on(date=Time.now)
      where(scheduledstart: date.in_time_zone("EST").beginning_of_day..date.in_time_zone("EST").end_of_day)
    end

    def in_range(start_date, end_date)
      # show games for dates. This might show some that are already live.
      where("playdate between (?) and (?)", start_date, end_date).order(
          playdate: :asc)
    end



  end


end
