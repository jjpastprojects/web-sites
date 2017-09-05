module StatsClient
  class Address
    attr_accessor :id, :state, :country
    include StatsClient::BaseResource

    def city=(city_name)
      @city = city_name
    end

    def country=(country_hash)
      @country = country_hash['name']
    end

    def state=(state_hash)
      @stats = state_hash['name']
    end

    def method_name_for_attr(attr)
      {'nickname' => 'name', 'teamId' => 'id'}[attr] || self.class.method_name_for_attr(attr)
    end
  end
end