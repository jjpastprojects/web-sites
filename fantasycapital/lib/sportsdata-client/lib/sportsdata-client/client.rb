require 'httparty'

module SportsdataClient
  class Client
    RETRY_DELAY = 3
    RETRIES = 5

    include HTTParty
    #debug_output $stderr if ((defined? Rails) && Rails.env.development?)
    logger SportsdataClient.logger, :info, :apache
    base_uri SportsdataClient.base_url

    attr_reader :action_prefix

    def request(action, params = {}, &block)
      params.merge! api_key: @api_key
      params.delete_if { |k, v| v.nil? || v.empty? }
      response = with_retries { self.class.get(api_url(action), query: params) }
      parse_response response, &block
    end

    protected
    def initialize(action_prefix, api_key)
      @action_prefix = action_prefix
      @api_key = api_key
    end

    def api_url(action)
       "/#{action_prefix}/#{action}"
    end

    def parse_response(response, &block)
      if response.success?
        results =  block_given? ? yield(response.parsed_response) : response.parsed_response
        results
      else
        raise RuntimeError, (SportsdataClient::FailureResponse.new response, response)
      end
    end

    def with_retries(&block)
      retries_left = max_retries
      begin
        response = nil
        retries_left.times do
          response = yield
          case response.code
          when 500...600
            puts "sleeping for for retry"
            sleep interval
          else
            return response
          end
        end
        response
      rescue Errno::ECONNREFUSED, SocketError, Net::ReadTimeout
        if (retries_left -= 1) > 0
        puts "sleeping for for retry"
        sleep interval
        retry
        else
          raise
        end
      end
    end

    def max_retries
      RETRIES
    end
    
    def interval
      RETRY_DELAY
    end
  end
end
