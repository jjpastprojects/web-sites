module StatsClient
  class SuccessResponse < StatsClient::APIResponse
    def success?
      true
    end
  end
end