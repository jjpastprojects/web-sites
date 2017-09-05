# == Schema Information
#
# Table name: projection_game_playeds
#
#  id         :integer          not null, primary key
#  player_id  :integer
#  game_id    :integer
#  created_at :datetime
#  updated_at :datetime
#

# Read about factories at https://github.com/thoughtbot/factory_girl

FactoryGirl.define do
  factory :projection_game_played, :class => 'Projection::GamePlayed' do
    player nil
    game nil
  end
end
