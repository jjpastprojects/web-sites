# == Schema Information
#
# Table name: projection_games
#
#  id           :integer          not null, primary key
#  start_date   :datetime
#  created_at   :datetime
#  updated_at   :datetime
#  ext_game_id  :string(255)
#  home_team_id :integer
#  away_team_id :integer
#  sport        :string(255)      default("NBA")
#

module Projection
  class Game < ActiveRecord::Base
    belongs_to :team
    belongs_to :home_team, class_name: Team
    belongs_to :away_team, class_name: Team
    has_many :stats, inverse_of: :game
    validates :sport, presence: true
    validates_uniqueness_of :ext_game_id

    def self.refresh_all(sport_name, games_src, cutoff=(Time.now-10.days))
      updated_games = []
      # "closed" status means the game has finished
      games_src.select {|g| g["status"] == "closed"}.each do |game_src|

        game_start = Time.parse(game_src["scheduled"])
        next if game_start < cutoff

        home_team = Team.find_by_ext_team_id game_src["home_team"]
        away_team = Team.find_by_ext_team_id game_src["away_team"]
        unless home_team && away_team
          logger.warn "Either #{game_src["home_team"]} or #{game_src["away_team"]} is not found..."
          logger.warn "Skipping #{game_src}"
          next
        end

        # Create a ProjectionGame for this game.
        game = Game.where(ext_game_id: game_src["id"]).first_or_initialize
        game.sport = sport_name
        game.start_date = game_start
        game.home_team = home_team
        game.away_team = away_team
        begin
          game.save!
        rescue ActiveRecord::RecordInvalid => invalid
          puts invalid.record.errors.to_a
          raise
        end

        updated_games << game
      end
      updated_games
    end

    def refresh_stats(teams_src, sportname)
      cal = FantasyPointCalculator.create_for_sport(sportname)

      raise "Unexpected teams" unless teams_src.length == 2
      # select all players that played in the game, and record their stats and that they played.
      all_players = teams_src[0]['players']['player'] + teams_src[1]['players']['player']
      all_players.select {|x| x['played']  && x['played'] == 'true'}.each do |player_src|

        player = Player.find_by_ext_player_id player_src["id"]
        if player.nil?
          logger.warn "#{player_src["id"]} not found...."
          logger.warn "Skipping #{player_src}"
          next
        end

        #keep track of what games this player has played
        GamePlayed.where(player: player, game: self).first_or_create

        #Refresh stats accordingly, also add calculated fp (Fantasy Point)
        fp = cal.weighted_fp { |stat_name, weight|
          player_src["statistics"][stat_name].to_f
        }
        statcls = Stat.class_for_sport(sportname)
        statcls.refresh player, self, player_src["statistics"].merge({"fp"=>fp})

      end #of team_src['players']['player'].select {|x| x['played']  && x['played'] == 'true'}.each
    end

  end
end
