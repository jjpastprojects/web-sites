module StatsClient
  class StatsGateway
    cattr_reader :client

    def initialize

    end

    class << self
      def client
        @@client ||= StatsClient::Client.new  self.action_prefix
      end
    end
  end
end