# == Schema Information
#
# Table name: player_stats
#
#  id               :integer          not null, primary key
#  player_id        :integer
#  stat_name        :string(255)
#  stat_value       :string(255)
#  created_at       :datetime
#  updated_at       :datetime
#  dimension        :string(255)
#  time_span        :string(255)
#  display_priority :integer
#

class PlayerStat < ActiveRecord::Base
	belongs_to :player

	STATS_ALLOWED = { 
      "MPG" => nil,
      "RPG" => nil,
      "APG" => nil,
      "BLKPG" => nil,
      "STLPG" => nil,
      "PFPG" => nil,
      "TOPG" => nil,
      "PPG" => nil,
      "FPPG" => nil
    }

	class << self
		def player_stat_line(player_id, kind, time_span)
			stats = PlayerStat.where("player_id = ? AND dimension = ? AND time_span = ?", player_id, kind, time_span)
			stat_line = {}
			stats.each do |s|
				stat_line[s.stat_name] = s.stat_value
			end
			stat_line
		end
	end
end
