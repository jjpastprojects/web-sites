module SportsdataClient
  class SportsdataGateway
    cattr_reader :client


    def initialize

    end

    class << self
      attr_accessor :api_key # set from application initializer. Separate API key per sport

      def client
        @client ||= SportsdataClient::Client.new(self.action_prefix, self.api_key)
      end
    end
  end
end
