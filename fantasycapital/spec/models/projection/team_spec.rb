# == Schema Information
#
# Table name: teams
#
#  id          :integer          not null, primary key
#  name        :string(255)
#  teamalias   :string(255)
#  ext_team_id :string(255)
#  created_at  :datetime
#  updated_at  :datetime
#

require 'spec_helper'

describe Projection::Team do
  pending "add some examples to (or delete) #{__FILE__}"
end
