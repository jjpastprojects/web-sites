# == Schema Information
#
# Table name: projection_stats
#
#  id         :integer          not null, primary key
#  stat_name  :string(255)
#  stat_value :decimal(, )
#  player_id  :integer
#  game_id    :integer
#  created_at :datetime
#  updated_at :datetime
#

require 'spec_helper'

describe Projection::Stat do
  pending "add some examples to (or delete) #{__FILE__}"
end
