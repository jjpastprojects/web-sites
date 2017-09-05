# == Schema Information
#
# Table name: projection_players
#
#  id            :integer          not null, primary key
#  name          :string(255)
#  created_at    :datetime
#  updated_at    :datetime
#  team_id       :integer
#  is_current    :boolean
#  position      :string(255)
#  ext_player_id :string(255)
#

# Read about factories at https://github.com/thoughtbot/factory_girl

FactoryGirl.define do
  factory :projection_player, :class => 'Projection::Player' do
    sequence(:ext_player_id) { |n| "ext-player-#{n}" }
    name "MyString"
    team
  end
end
