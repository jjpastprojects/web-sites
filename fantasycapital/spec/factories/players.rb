# == Schema Information
#
# Table name: players
#
#  id                :integer          not null, primary key
#  created_at        :datetime
#  updated_at        :datetime
#  sport_position_id :integer
#  salary            :integer
#  first_name        :string(255)
#  last_name         :string(255)
#  dob               :date
#  ext_player_id     :string(255)
#  team_id           :integer
#

# Read about factories at https://github.com/thoughtbot/factory_girl

FactoryGirl.define do
  factory :player do
    sequence(:first_name) { |n| "Bruce#{n}" }
    last_name "Acy"
    sequence(:ext_player_id) { |n| "ext#{n}" }
    association :team
    dob { Date.today - 15.year }
    sport_position
  end
end
