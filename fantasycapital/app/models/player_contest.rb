# == Schema Information
#
# Table name: player_contests
#
#  id         :integer          not null, primary key
#  player_id  :integer
#  contest_id :integer
#  created_at :datetime
#  updated_at :datetime
#

class PlayerContest < ActiveRecord::Base
  belongs_to :contest
  belongs_to :player
end
