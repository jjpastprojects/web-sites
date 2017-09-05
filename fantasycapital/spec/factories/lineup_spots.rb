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

# Read about factories at https://github.com/thoughtbot/factory_girl

FactoryGirl.define do
  factory :lineup_spot do
    sport_position nil
    lineup nil
    player nil
    spot 1
  end
end
