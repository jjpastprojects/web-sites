# == Schema Information
#
# Table name: projection_game_playeds
#
#  id         :integer          not null, primary key
#  player_id  :integer
#  game_id    :integer
#  created_at :datetime
#  updated_at :datetime
#

class Projection::GamePlayed < ActiveRecord::Base
  belongs_to :player
  belongs_to :game
end
