module StatsClient
  module ResponseParser
    class DatetimeParser

      class << self
        def parse(datetime_node)
          return datetime_node if datetime_node.is_a?(Date)
          date = if datetime_node.is_a?(Array)
                   datetime_node.select { |d| d['dateType'] == 'UTC' }.first['full']
                 else
                   datetime_node['full']
                 end
          DateTime.parse(date+ "+00:00")
        end
      end

    end
  end
end
