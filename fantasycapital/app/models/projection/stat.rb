# == Schema Information
#
# Table name: projection_stats
#
#  id         :integer          not null, primary key
#  stat_name  :string(255)
#  stat_value :decimal(, )
#  player_id  :integer
#  game_id    :integer
#  created_at :datetime
#  updated_at :datetime
#

module Projection
  class Stat < ActiveRecord::Base
    belongs_to :game
    belongs_to :player

    SPORTS = {}
    @stats_allowed = {}

    def self.class_for_sport sportname
      # factory method to return an instance of a FantasyPointCalculator subclass for the
      # requested sport. Sport subclasses are defined below this class.
      SPORTS[sportname.to_s]
    end

    class << self
      attr_accessor :stats_allowed

      def refresh(player, game, stats)
        stats.select {|k,v| @stats_allowed.keys.include? k}.each do |stat_n, stat_v|
          st = Stat.where(player: player, game: game, stat_name: stat_n).first_or_initialize 
          st.stat_value = @stats_allowed[stat_n] ? @stats_allowed[stat_n].call(stat_v) : stat_v
          st.save!
        end
      end

    end

    protected
    def self.register_sport sportname
      # allow subclass to register itself here
      SPORTS[sportname] = self
    end



  end

  class NBA_Stat < Stat
    register_sport "NBA"

    # these are the parameters that come from the sportsdata API.
    @stats_allowed = {  # class instance variable
        "fp" => nil,
        "points" => nil,
        "assists" => nil,
        "steals" => nil,
        "rebounds" => nil,
        "blocks" => nil,
        "turnovers" => nil,
        "personal_fouls" => nil,
        "minutes" => lambda {|x| (m,s) = x.split(":"); m.to_f + s.to_f/60.0}
    }


  end

  class MLB_Stat < Stat
    register_sport "MLB"
    # This is similar to the list in fantasy_point_calculator (where the fields used to create
    # fantasy points are stored). But I *think* this list is used to capture stats we want to show
    # a user. Maybe? I'm sure we'll be coming back to this...

    # these are the parameters that come from the sportsdata API.
    @stats_allowed = { # class instance variable
        "fp" => nil,
        's' => nil,
        'd' => nil,
        't' => nil,
        'hr' => nil,
        'rbi' => nil,
        'runs' => nil,
        'bb' => nil,
        'stolen' => nil,
        'hbp' => nil,
        'ktotal' => nil
    }

  end

end
