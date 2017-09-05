require 'httparty'

module StatsClient
  class Client
    RETRY_DELAY = 3
    RETRIES = 5

    include HTTParty
    #debug_output $stderr if Rails.env.development?
    #logger StatsClient.logger, :info, :apache
    base_uri StatsClient.base_url
    default_params accept: 'json'

    attr_reader :action_prefix

    def request(action, params = {}, &block)
      params.merge! sig: generate_stats_signature, api_key: StatsClient.api_key

      params.delete_if { |k, v| v.nil? || v.empty? }
      raw_response = self.class.get(api_url(action), query: params)

      if is_xml_request?(params)
        response = StatsClient::ResponseParser::XmlParser.parse(raw_response.body)
      else
        response = raw_response.body
      end
      response = with_retries { raw_response }

      parse_response raw_response, response, &block
    end

    protected
    def initialize(action_prefix)
      @action_prefix = action_prefix
    end

    def is_xml_request?(params)
      params[:accept] == 'xml'
    end

    def generate_stats_signature
     digest_string = StatsClient.api_key + StatsClient.api_secret + Time.now.utc.to_i.to_s
     digest        = Digest::SHA256.new
     digest.update(digest_string).to_s
    end

    def api_url(action)
       "/#{action_prefix}/#{action}"
    end

    def parse_response(http_request, response, &block)
      if http_request.success?
        results =  block_given? ? yield(response['apiResults']) : response['apiResults']
        StatsClient::SuccessResponse.new response, results
      else
        StatsClient::FailureResponse.new response, response
      end
    end

    def with_retries(&block)
      begin
        RETRIES.times do
          response = yield
          case response.code
          when 500...600
            puts "sleeping for for retry"
            sleep RETRY_DELAY
          else
            return response
          end
          response
        end
      rescue Errno::ECONNREFUSED, SocketError, Net::ReadTimeout
        puts "sleeping for for retry"
        sleep RETRY_DELAY
        retry
      end
    end
    
  end
end
