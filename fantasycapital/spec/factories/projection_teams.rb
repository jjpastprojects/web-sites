# == Schema Information
#
# Table name: projection_teams
#
#  id          :integer          not null, primary key
#  name        :string(255)
#  created_at  :datetime
#  updated_at  :datetime
#  is_current  :boolean
#  ext_team_id :string(255)
#

# Read about factories at https://github.com/thoughtbot/factory_girl

FactoryGirl.define do
  factory :project_team, :class => 'Projection::Team' do
    name "MyString"
    sequence(:ext_team_id) { |n| "ext-team-#{n}" }

  end
end
