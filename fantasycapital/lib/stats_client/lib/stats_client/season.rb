module StatsClient
  class Season
    attr_accessor :season, :name, :active

    include StatsClient::BaseResource

    def active?
      active
    end

    def method_name_for_attr(attr)
      { 'isActive' => 'active' }[attr] || self.class.method_name_for_attr(attr)
    end

  end
end
