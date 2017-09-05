module LineupsHelper
  def collection_for_sports_options
    Contest.group(:sport).pluck(:sport).map do |sport|
      [sport, sport]
    end
  end

  def consumed_salary(lineup)
    lineup.players.sum(:salary)
  end

end
