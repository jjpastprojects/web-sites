# == Schema Information
#
# Table name: lineup_spot_protos
#
#  id                  :integer          not null, primary key
#  sport               :string(255)
#  sport_position_name :string(255)
#  spot                :integer
#  created_at          :datetime
#  updated_at          :datetime
#

class LineupSpotProto < ActiveRecord::Base
end
