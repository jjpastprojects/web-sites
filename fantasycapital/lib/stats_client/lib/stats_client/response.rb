module StatsClient
  class APIResponse
    attr_reader :result
    attr_reader :payload

    def initialize(payload, result)
      @payload = payload
      @result  = result
    end

    def success?
       false
    end

    def failed?
      false
    end
  end
end