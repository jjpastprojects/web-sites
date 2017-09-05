require 'stats_client/stats/base_stats'

module StatsClient
  module Stats
    class TeamStats < StatsClient::Stats::BaseStats
      attr_reader :team

      def initialize
        super
        @team = StatsClient::Team.new
      end

      def slice_response_hash(response)
        sliced_response = response.slice! 'teamId', 'location', 'nickname', 'abbreviation'
        @team.copy_instance_variables_from_hash response

        sliced_response
      end

    end
  end
end

