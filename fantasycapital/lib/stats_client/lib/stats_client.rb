module StatsClient
  # stats account secret
  mattr_accessor :api_secret

  mattr_accessor :api_key
  @@base_url = 'http://api.stats.com/v1'.freeze

  mattr_accessor :logger
  class << self
    def configure
      yield self
    end

    def base_url
      @@base_url
    end

    def logger
     @@logger ||= ::Logger.new('log/stats_client.log')
    end
  end
end

require 'stats_client/stats_gateway'
require 'stats_client/utility'
require 'stats_client/base_resource'
require 'stats_client/response'
require 'stats_client/response_parser/xml_parser'
require 'stats_client/address'
require 'stats_client/venue'
require 'stats_client/stats/player_stats'
require 'stats_client/stats/team_stats'
require 'stats_client/season'
require 'stats_client/team'
require 'stats_client/sport'
require 'stats_client/failure_response'
require 'stats_client/success_response'
require 'stats_client/response_parser/response_parser'
require 'stats_client/response_parser/simple_parser'
require 'stats_client/response_parser/datetime_parser'
require 'stats_client/client'
require 'stats_client/player'
require 'stats_client/sports/football'
require 'stats_client/sports/basketball'
