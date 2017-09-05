module StatsClient
  module ResponseParser
    class SimpleParser
      attr_reader :result

      def initialize(payload)
        @payload = payload
        @result  = []
      end

      def parse(parent_node)
        find_resource_node @payload, parent_node
        @result
      end

      def find_resource_node(entry, node_key)
        case entry
          when Array
            entry.each do |child|
              find_resource_node child, node_key
            end
          when Hash
            entry.keys.each do |key|
              if key == node_key
                @result.push(*entry[key])
                return
              else
                find_resource_node entry[key], node_key
              end
            end
        end
      end

    end
  end
end
