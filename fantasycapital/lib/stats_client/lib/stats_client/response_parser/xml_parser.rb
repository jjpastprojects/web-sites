require 'crack' # for xml and json
require 'crack/xml' # for just xml

module StatsClient
  module ResponseParser
    class XmlParser

      class << self
        def parse(response)
          Crack::XML.parse(response)
        end
      end

    end
  end
end
