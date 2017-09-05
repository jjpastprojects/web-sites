# == Schema Information
#
# Table name: projection_stats
#
#  id         :integer          not null, primary key
#  stat_name  :string(255)
#  stat_value :decimal(, )
#  player_id  :integer
#  game_id    :integer
#  created_at :datetime
#  updated_at :datetime
#

# Read about factories at https://github.com/thoughtbot/factory_girl

FactoryGirl.define do
  factory :projection_stat, :class => 'Projection::Stat' do
    stat_name "MyString"
    stat_value "9.99"
    association :player, factory: :projection_player
    association :game, factory: :projection_game
  end
end
