module SportsdataClient
  class SuccessResponse < SportsdataClient::APIResponse
    def success?
      true
    end
  end
end
