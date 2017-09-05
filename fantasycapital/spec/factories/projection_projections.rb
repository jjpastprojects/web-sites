# == Schema Information
#
# Table name: projection_projections
#
#  id                :integer          not null, primary key
#  scheduled_game_id :integer
#  player_id         :integer
#  fp                :decimal(, )
#  created_at        :datetime
#  updated_at        :datetime
#

# Read about factories at https://github.com/thoughtbot/factory_girl

FactoryGirl.define do
  factory :projection_projection, :class => 'Projection::Projection' do
    game nil
    player nil
    fp "9.99"
  end
end
