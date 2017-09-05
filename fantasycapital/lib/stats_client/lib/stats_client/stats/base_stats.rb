require 'stats_client/stats/stats_types'
require 'stats_client/stats/stats_entry'

module StatsClient
  module Stats
    class BaseStats
      attr_accessor :stats_entries, :seasons
      include StatsClient::BaseResource

      def initialize
        @stats_entries = []
      end

      def seasons=(season_collection)
        season_collection.each do |season_hash|
          create_stats_entry_for_season_events(season_hash)
        end
      end

      def create_stats_entry_for_season_events(event_hash)
        sliced_hash = event_hash.slice!('name', 'eventTypeId')

        sliced_hash['eventType'].each do |event_type_hash|
          event_type_hash['splits'].each do |event_split|
            if event_split.has_key? 'teamStats'
              event_split['teamStats'].each do |stats_hash|
                stats_hash.merge! event_name: event_hash['name']
                entry = StatsClient::Stats::StatsEntry.new
                entry.copy_instance_variables_from_hash stats_hash
                @stats_entries.push entry
              end

            elsif event_split.has_key? 'playerStats'
              stats_hash = event_split['playerStats']
              stats_hash.merge! event_name: event_hash['name']
              entry = StatsClient::Stats::StatsEntry.new
              entry.copy_instance_variables_from_hash stats_hash
              @stats_entries.push entry
            end
          end
        end
      end

      def method_name_for_attr(attr)
        {'nickname' => 'name', 'teamId' => 'team_id'}[attr] || self.class.method_name_for_attr(attr)
      end

    end
  end
end

