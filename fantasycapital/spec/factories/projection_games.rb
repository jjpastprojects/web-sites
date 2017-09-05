# == Schema Information
#
# Table name: projection_games
#
#  id           :integer          not null, primary key
#  start_date   :datetime
#  created_at   :datetime
#  updated_at   :datetime
#  ext_game_id  :string(255)
#  home_team_id :integer
#  away_team_id :integer
#  sport        :string(255)      default("NBA")
#

# Read about factories at https://github.com/thoughtbot/factory_girl

FactoryGirl.define do
  factory :projection_game, :class => 'Projection::Game' do
    start_date "2014-01-07"
    sequence(:ext_game_id) { |n| "ext-game-#{n}" }

  end
end
