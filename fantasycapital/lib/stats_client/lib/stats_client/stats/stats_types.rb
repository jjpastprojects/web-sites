module StatsClient
  module Stats
    class PercentageStatsType
      include StatsClient::BaseResource

      attr_accessor :percentage, :made, :attempted
    end

    class FieldGoal < PercentageStatsType
    end

    class FreeThrow < PercentageStatsType
    end

    class ThreePointFieldGoals < PercentageStatsType
    end

    class Rebound
      attr_accessor :total, :total_per_game, :offensive, :offensive_per_game, :defensive, :defensive_per_game, :team

      include StatsClient::BaseResource

      def method_name_for_attr(attr)
        {'totalPerGame' => 'total_per_game', 'offensivePerGame' => 'offensive_per_game',
         'defensivePerGame' => 'defensive_per_game'
        }[attr] || self.class.method_name_for_attr(attr)
      end
    end
  end
end
