# == Schema Information
#
# Table name: players
#
#  id                :integer          not null, primary key
#  created_at        :datetime
#  updated_at        :datetime
#  sport_position_id :integer
#  salary            :integer
#  first_name        :string(255)
#  last_name         :string(255)
#  dob               :date
#  ext_player_id     :string(255)
#  team_id           :integer
#

class Player < ActiveRecord::Base
  PRIORITIZE_SEQUENCE_NUMBER = 1
  FP_TO_SALARY_MULTIPLIER    = 250
  PLAYER_MIN_SALARY = 3000

  # record display-order of stats, and translation between API names and display names of stats
  STATS_ORDERED =
      {"NBA" => {'points' => 'P', 'rebounds' => 'R', 'assists' => 'A', 'steals' => 'S',
                  'blocks' => 'B', 'turnovers' => 'T'},
       "MLB" => {'s' => 'S', 'd' => 'D', 't' => 'T', 'hr' => 'HR', 'rbi' => 'RBI',
                 'runs' => 'R', 'bb' => 'BB', 'stolen' => 'SB', 'hbp' => 'HBP', 'ktotal' => 'K' }
      }

  belongs_to :team
  belongs_to :sport_position
  has_many :player_stats, inverse_of: :player
  has_many :player_real_time_scores
  validates :sport_position_id, presence: true    # don't allow nil sport-position
  validates :ext_player_id, uniqueness: true
  has_many :lineup_spots

  def name
    "#{first_name} #{last_name}"
  end

  def realtime_fantasy_points(gamescore=nil)
    # return current real-time-fantasy score for a particular game ID, or array of gameid's.
    # to use an eager-loaded association that's been pre-filtered to only include the relevant game(s),
    # make sure gameid is nil.

    # if this player has an eager-loaded set of realtime scores, use those to save queries.
    # those should already be pre-scoped to the game-ids we care about.
    if gamescore.nil? && (self.association_cache.keys.include? :player_real_time_scores)
      fpsarray = self.player_real_time_scores.to_a.select { |x| x['name'] == 'fp' }
      if fpsarray.length > 1
        ext_game_ids = fpsarray.map {|x| GameScore.find(x['game_score_id']).ext_game_id}
        raise "More than one cached fantasy score for #{self.name}. Games=#{ext_game_ids}"
      end

      fps = fpsarray[0]
    else
      fpsarray = player_real_time_scores.where(game_score: gamescore, name: 'fp')
      raise "More than one fantasy score for #{self.name}" if fpsarray.count > 1
      fps = fpsarray.first
    end

    fps.try(:value) || 0
  end

  def fantasy_points
    Projection::Projection.where(player_id: Projection::Player.where(ext_player_id: ext_player_id).first).order(updated_at: :desc).first.try(:fp) || 0
  end



  def rtstats(sport, game_score=nil)

    # return the score-string (ie "0 P 0 R 0 S ...") for this player in a particular game.
    # can pass an array of gameids. Make sure we assemble in right order.
    # to use an eager-loaded association that's been pre-filtered to only include the relevant game(s),
    # make sure gameid is nil.

    # if this player has an eager-loaded set of realtime scores, use those to save queries.
    # those should already be pre-scoped to the game-ids we care about.
    # In MLB the printed fields are:
    #    Players: 1B, 2B, 3B, HR, RBI, R, BB, SB, HBP, K
    #    Pitchers: IP, K, ER, W/L, CG, NH
    if game_score.nil? && (self.association_cache.keys.include? :player_real_time_scores)
      stats = self.player_real_time_scores.to_a
    else
      stats = player_real_time_scores.where(game_score: game_score)
    end
    display_order = STATS_ORDERED[sport].keys
    rtstats = []
    stats.each do |stat|
      idx = display_order.index(stat.name)
      unless idx.nil?
        statval = stat.value.to_i
        if statval > 0
          rtstats[idx] = statval.to_s + STATS_ORDERED[sport][stat.name]
        else
          rtstats[idx] = nil
        end
      end

    end
    # use 'compact' to remove nil entries (for stats w/ 0 values or if we only have partial data)
    rtstats.compact.join(" ").upcase
  end

  class << self
    def refresh_all(players_src, team_id, sport)
      # called by rake stats.fetch_players task
      players_src.each do |player_src|
        player = Player.where(ext_player_id: player_src['id']).first_or_initialize
        player.last_name = player_src['last_name']
        player.first_name = player_src['first_name']

        player.team = Team.find_by!(ext_team_id: team_id)

        player.dob = Time.parse(player_src['birthdate']) unless player_src['birthdate'].empty?

        #salary is fp * 250 rounded to nearest 100
        salary = (player.fantasy_points * FP_TO_SALARY_MULTIPLIER / 100.0).round * 100
        #min 3000
        player.salary = [salary, PLAYER_MIN_SALARY].max

        # Look for player's position from specific (primary_position) to generic (position). For
        # example, in MLB a player could be LF (left field) in primary_position, but we want
        # the generic OF (outfield) value which is in position field.
        player.sport_position = SportPosition.where(
           name: [player_src['primary_position'], player_src['position']],
           sport: sport.to_s).first
        if player.sport_position.nil?
          Rails.logger.error "Player has unknown position: #{player_src}"
          player.sport_position = SportPosition.find_by!(name:"INVALID")
        end

        begin
          player.save!
        rescue ActiveRecord::RecordInvalid => invalid
          puts invalid.record.errors
          raise
        end
      end
    end

    def with_summary_fppg
      # return players with their summary FPPG stats as a 'joins'. Caller can then 'select' out
      # the fields they want to display, including the joined FPPG summary stat.

      # my most complex query ever:
      # we need the associated PlayerStat FPPG score marked 'summary' for each player, the one with
      # the highest display-priority.
      # 1. Use a LEFT JOIN so we get players with no stats. (we've seen a few of those)
      # 2. Put conditions in the JOIN (instead of in a where), again so we keep players
      #    without stats.
      # 3. Use a nested query to select only the Player+PlayerStat entry with highest display-priority
      joinclause = "LEFT JOIN player_stats ON player_stats.player_id = players.id " +
          "AND player_stats.stat_name = 'FPPG' AND player_stats.dimension = 'summary'"

      innerquery = "(SELECT MAX (player_stats.display_priority) from player_stats " +
          "WHERE player_stats.player_id = players.id)"

      joins(joinclause).where('player_stats IS null OR player_stats.display_priority= ' + innerquery)

    end

    def player_of_ext_id(ext_id)
      player = find_by_ext_player_id ext_id
      if player.nil?
        logger.warn "#{ext_id} not found.... Skipped"
      else
        yield player
      end
      player
    end

  end
end
