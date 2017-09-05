module StatsClient
  class Venue
    attr_accessor :id, :address,:name

    include StatsClient::BaseResource

    def initialize
      @address = StatsClient::Address.new
    end

    def city=(v)
      @address.city = v
    end

    def state=(stats)
      @address.stats = stats
    end

    def country=(country)
      @address.country = country
    end

    def method_name_for_attr(attr)
      {'venueId' => 'id'}[attr] || self.class.method_name_for_attr(attr)
    end
  end
end