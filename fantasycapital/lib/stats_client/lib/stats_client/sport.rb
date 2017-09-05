module StatsClient
  class Sport
    attr_accessor :id, :start_date, :is_tba, :venue, :confirmation_stats, :tv_stations, :event_status, :venue, :coverage_stats

    include StatsClient::BaseResource

    def initialize
      @confirmations_stats = {}
      @venue = StatsClient::Venue.new
      @coverage_stats = {}
      @teams = []
    end

    def is_data_confirmed=(confirmations)
      @confirmations_stats.merge! confirmations
    end

    def start_date=(date)
      @start_date = StatsClient::ResponseParser::DatetimeParser.parse(date)
    end

    def venue=(v)
      @venue.copy_instance_variables_from_hash v
    end

    def teams=(teams)
      teams.each do |team_hash|
        team = StatsClient::Team.new
        team.copy_instance_variables_from_hash team_hash
        @teams.push team
      end
    end

    def coverage_level=(coverage)
      @coverage_stats.merge! coverage
    end

    def method_name_for_attr(attr)
      {'eventId' => 'id'}[attr] || self.class.method_name_for_attr(attr)
    end
  end
end