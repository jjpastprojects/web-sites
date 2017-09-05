# == Schema Information
#
# Table name: projection_players
#
#  id            :integer          not null, primary key
#  name          :string(255)
#  created_at    :datetime
#  updated_at    :datetime
#  team_id       :integer
#  is_current    :boolean
#  position      :string(255)
#  ext_player_id :string(255)
#

module Projection
  class Player < ActiveRecord::Base
    belongs_to :team
    has_one :projection
    validates :ext_player_id, uniqueness: true

    class << self
      def refresh(teams_array)
        # step through a hash w/ ext-team-id as key, array of players from external API as data,
        # and update the player data.
        teams_array.each do |ext_team_id, players_src|
          if players_src.nil?
            puts "Huh?"
            next
          end
          players_src.each do |player_src|
            player = Player.where(ext_player_id: player_src['id']).first_or_initialize
            # NOTE: NBA data uses 'full_name' variable. MLB uses preferred_name + last_name.
            #   Ideally we should go back to the sportsdata-client and make these two consistent
            #   there.
            if player_src['full_name']
              player.name = player_src['full_name']
            else
              player.name = player_src['preferred_name'] + ' ' + player_src['last_name']
            end

            player.is_current = true
            player.team = Team.find_by!(ext_team_id: ext_team_id)
            player.position = player_src['primary_position']
            player.save!
          end
        end


      end
    end


    def method_missing(method_name, *args, &block)
      if m = /^last_(\d+)_game[s]*$/.match(method_name)
        self.last_games(m[1].to_i)
      elsif m = /^the_(\d+)\w\w_game_to_last$/.match(method_name)
        self.the_game_to_last(m[1].to_i)
      else
        super
      end
    end
    
    def last_games(x)
      GamePlayed.includes(:game).where(player: self).sort {
          |a,b| a.game.start_date <=> b.game.start_date
      }.last(x).map {|g| g.game}
    end

    def the_game_to_last(x)
      self.last_games(x+1).reverse[x,1]
    end

    def home_games
      GamePlayed.includes(:game).where(player: self, "projection_games.home_team_id" => self.team).map {|g| g.game} 
    end

    def away_games
      GamePlayed.includes(:game).where(player: self, "projection_games.away_team_id" => self.team).map {|g| g.game} 
    end

    def all_games
      GamePlayed.includes(:game).where(player: self).map {|g| g.game} 
    end

  end
end
