require 'stats_client/stats/base_stats'

module StatsClient
  module Stats
    class PlayerStats < StatsClient::Stats::BaseStats
      attr_reader :player

      def initialize
        super
        @player = StatsClient::Player.new
      end

      def slice_response_hash(response)
        sliced_response = response.slice! 'playerId', 'firstName', 'lastName'
        @player.copy_instance_variables_from_hash response

        sliced_response
      end
   end
  end
end

