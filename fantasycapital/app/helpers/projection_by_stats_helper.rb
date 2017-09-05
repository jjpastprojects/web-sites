module ProjectionByStatsHelper
  def stat_of(projection, stat_name)
    projection.projection_by_stats.select {|s| s.stat_name == stat_name}[0]
  end

end
