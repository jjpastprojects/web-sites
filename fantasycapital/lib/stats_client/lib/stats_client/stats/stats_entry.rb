module StatsClient
  module Stats
    class StatsEntry
      attr_accessor :season, :games_played, :games_started, :event_name,
                    :total_seconds_played, :points, :total_seconds_played, :minutes_per_game,
                    :field_goals, :assists_per_game, :blocked_shots, :plus_minus, :turnovers_per_game,
                    :personal_fouls, :points_per_game, :field_goals, :free_throws, :rebounds, :personal_fouls_received,
                    :blocked_shots_against, :blocked_shots_against_per_game, :assists, :steals, :steals_per_game, :blocked_shots_per_game, :blockedShots_against_per_game,
                    :turnovers, :disqualifications, :technical_fouls, :flagrant_fouls, :ejections, :triple_doubles, :double_doubles, :high_game_points,
                    :assist_to_turnover_ratio, :steal_to_turnover_ratio, :effective_field_goal_percentage, :team_own_flag, :team_turnovers, :team_technical_fouls,
                    :coach_technical_fouls, :bench_technical_fouls, :defensive3_seconds, :coach_ejections, :points_off_turnovers, :points_in_paint,
                    :second_chance_points,:fast_break_points


      include StatsClient::BaseResource

      def field_goals=(goals)
        @field_goals = FieldGoal.new
        @field_goals.copy_instance_variables_from_hash goals
      end

      def free_throws=(throws)
        @free_throws = FreeThrow.new
        @field_goals.copy_instance_variables_from_hash throws
      end

      def three_point_field_goals=(goals)
        @three_point_field_goals = ThreePointFieldGoals.new
        @three_point_field_goals.copy_instance_variables_from_hash goals
      end

      def rebounds=(rebound)
        @rebounds = Rebound.new
       @rebounds.copy_instance_variables_from_hash rebound
      end

      def slice_response_hash(response)
        sliced_response = response.slice! 'season', 'name', 'isActive'
        @season = StatsClient::Season.new
        @season.copy_instance_variables_from_hash response

        sliced_response
      end

      #class << self
      # def method_name_for_attr(attr)
          #{ 'gamesPlayed'        => 'games_played',         'gamesStarted'               => 'games_started',
          #  'totalSecondsPlayed' => 'total_seconds_played', 'points'                     => 'points',
          #  'minutesPerGame'     => 'minutes_per_game',     'pointsPerGame'              => 'points_per_game',
          #  'fieldGoals'         => 'field_goals',          'threePointFieldGoals'       => 'three_point_field_goals',
          #  'assistsPerGame'     => 'assists_per_game',     'stealsPerGame'              => 'steals_per_game',
          #  'blockedShots'       => 'blocked_shots',        'blockedShotsPerGame'        => 'blocked_shots_per_game',
          #  'plusMinus'          => 'plus_minus',           'blockedShotsAgainstPerGame' => 'blockedShots_against_per_game',
          #  'turnoversPerGame'   => 'turnovers_per_game',   'blockedShotsAgainst'        => 'blocked_shots_against',
          #  'personalFouls'      => 'personal_fouls',       'personalFoulsReceived'      => 'personal_fouls_received',
          #  'eventType'          => 'event_type',           'freeThrows'                 => 'free_throws',
          #  'technicalFouls'     => 'technical_fouls',      'flagrantFouls'              => 'flagrant_fouls',
          #  'tripleDoubles'      => 'triple_doubles',       'doubleDoubles'              => 'double_doubles',
          #
          #}[attr] || attr
       # end
      #end
    end
  end
end

