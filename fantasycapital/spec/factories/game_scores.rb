# == Schema Information
#
# Table name: game_scores
#
#  id              :integer          not null, primary key
#  playdate        :date
#  ext_game_id     :string(255)
#  scheduledstart  :datetime
#  home_team_id    :integer
#  away_team_id    :integer
#  home_team_score :integer
#  away_team_score :integer
#  status          :string(255)
#  clock           :integer
#  period          :integer
#  created_at      :datetime
#  updated_at      :datetime
#  sport           :string(255)      default("NBA")
#

# Read about factories at https://github.com/thoughtbot/factory_girl

FactoryGirl.define do
  sequence :ext_game_id do |n|
    "ABC#{n}-GAME-IJKL"
  end

  factory :game_score do
    playdate "2014-03-12"
    home_team_score 1
    away_team_score 1
    status "scheduled"
    association :home_team, factory: :team
    association :away_team, factory: :team
    gamelength 48
    progress 0
    ext_game_id
    scheduledstart {"#{playdate.to_time + 14.hours}"}
  end
end
