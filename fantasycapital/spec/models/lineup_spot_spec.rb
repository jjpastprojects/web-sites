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

require 'spec_helper'

describe LineupSpot do
  it { should belong_to :sport_position }
  it { should belong_to :lineup }
  it { should belong_to :player }
end
