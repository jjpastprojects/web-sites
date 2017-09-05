require 'stats_client/player_position'
module StatsClient
  class Player
    attr_accessor :id, :first_name, :last_name, :team, :positions, :date_of_birth, :team, :is_active

    include StatsClient::BaseResource

    def initialize
      @positions = []
      @team = StatsClient::Team.new
    end

    def positions=(positions_collection)
      positions_collection.each do |position_hash|
        position = StatsClient::PlayerPosition.new
        position.copy_instance_variables_from_hash position_hash

        self.positions.push position
      end
    end

    def date_of_birth=(birth)
      @date_of_birth = StatsClient::ResponseParser::DatetimeParser.parse(birth['birthDate'])
    end

    def team=(team_hash)
      @team.copy_instance_variables_from_hash(team_hash)
    end

    def method_name_for_attr(attr)
      {'playerId' => 'id', 'firstName' => 'first_name', 'lastName' => 'last_name', 'birth' => 'date_of_birth'}[attr] || self.class.method_name_for_attr(attr)
    end
  end
end
