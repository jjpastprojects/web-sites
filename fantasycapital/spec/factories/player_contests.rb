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

# Read about factories at https://github.com/thoughtbot/factory_girl

FactoryGirl.define do
  factory :player_contest do
  end
end
