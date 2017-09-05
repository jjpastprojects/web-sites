# == Schema Information
#
# Table name: sport_positions
#
#  id               :integer          not null, primary key
#  name             :string(255)
#  sport            :string(255)
#  display_priority :integer
#  created_at       :datetime
#  updated_at       :datetime
#  visible          :boolean          default(TRUE)
#

class SportPosition < ActiveRecord::Base
end
