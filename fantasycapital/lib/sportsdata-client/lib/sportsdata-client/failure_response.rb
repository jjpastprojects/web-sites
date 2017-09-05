module SportsdataClient
  class FailureResponse < APIResponse
    def error_message
     @result
    end

    def failed?
      true
    end
  end
end
