module StatsClient
  class Utility
    class << self
      def get_formatted_date(date)
        date.to_date.strftime "%Y-%m-%d"
      end
    end
  end
end