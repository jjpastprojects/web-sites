# == Schema Information
#
# Table name: projection_players
#
#  id            :integer          not null, primary key
#  name          :string(255)
#  created_at    :datetime
#  updated_at    :datetime
#  team_id       :integer
#  is_current    :boolean
#  position      :string(255)
#  ext_player_id :string(255)
#

require 'spec_helper'

describe Projection::Player do
  pending "add some examples to (or delete) #{__FILE__}"
end
