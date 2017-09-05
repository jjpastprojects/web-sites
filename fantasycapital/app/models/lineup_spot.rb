# == Schema Information
#
# Table name: lineup_spots
#
#  id                :integer          not null, primary key
#  sport_position_id :integer
#  lineup_id         :integer
#  player_id         :integer
#  spot              :integer
#  created_at        :datetime
#  updated_at        :datetime
#

class LineupSpot < ActiveRecord::Base
  belongs_to :sport_position
  belongs_to :lineup
  belongs_to :player
end
