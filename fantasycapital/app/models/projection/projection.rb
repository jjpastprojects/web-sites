# == Schema Information
#
# Table name: projection_projections
#
#  id                :integer          not null, primary key
#  scheduled_game_id :integer
#  player_id         :integer
#  fp                :decimal(, )
#  created_at        :datetime
#  updated_at        :datetime
#

module Projection
  class Projection < ActiveRecord::Base
    belongs_to :scheduled_game
    belongs_to :player
    has_many :projection_by_stats, :dependent => :delete_all

  end
end
