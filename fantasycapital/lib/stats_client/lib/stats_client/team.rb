module StatsClient
  class Team
    attr_accessor :id, :name, :location, :abbreviation, :record
    include StatsClient::BaseResource

    def method_name_for_attr(attr)
      {'nickname' => 'name', 'teamId' => 'id'}[attr] || self.class.method_name_for_attr(attr)
    end

  end
end

