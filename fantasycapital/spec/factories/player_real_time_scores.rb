# == Schema Information
#
# Table name: player_real_time_scores
#
#  id            :integer          not null, primary key
#  name          :string(255)
#  value         :decimal(, )
#  player_id     :integer
#  created_at    :datetime
#  updated_at    :datetime
#  game_score_id :integer
#

# Read about factories at https://github.com/thoughtbot/factory_girl

FactoryGirl.define do
  factory :player_real_time_score do
    name "MyString"
    value "9.99"
    game_score
    player
  end
end
