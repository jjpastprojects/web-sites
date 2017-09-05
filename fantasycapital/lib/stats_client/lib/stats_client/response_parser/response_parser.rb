module StatsClient
  module ResponseParser
    class ResponseParser
      attr_reader :result

      def initialize(payload, resource_class)
        @payload        = payload
        @resource_class = resource_class
        @result         = []
      end

      def parse(parent_node, options = {})
        case @payload
          when Array
            @payload.each do |entry|
              find_resource_node entry, parent_node, options
            end
          when Hash
            @payload.each do |entry|
              find_resource_node entry, parent_node, options
            end
        end

        @result
      end

      def slice_parent_attributes(entry, attrs)
        entry.slice *attrs if attrs.present?
      end

      def find_resource_node(entry, node_key, options={})
        case entry
          when Array
            entry.each do |child|
              find_resource_node child, node_key, options
            end
          when Hash
            entry.keys.each do |key|
              if key == node_key
                add_resource_entries entry[key], slice_parent_attributes(entry, options[:parent_attributes])
                return
              else
                find_resource_node entry[key], node_key, options
              end
            end
        end
      end


      protected

      def add_resource_entries(resource_hash_or_collection, parent_hash)
        if resource_hash_or_collection.is_a? Hash
          resource = @resource_class.new
          resource.copy_instance_variables_from_hash resource_hash_or_collection, parent_hash
          @result << resource
        else
          resource_hash_or_collection.each do |resource_hash|
            add_resource_entries resource_hash, parent_hash
          end
        end
      end
    end
  end
end
