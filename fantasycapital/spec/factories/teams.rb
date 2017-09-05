# == Schema Information
#
# Table name: teams
#
#  id          :integer          not null, primary key
#  name        :string(255)
#  teamalias   :string(255)
#  ext_team_id :string(255)
#  created_at  :datetime
#  updated_at  :datetime
#

# Read about factories at https://github.com/thoughtbot/factory_girl

FactoryGirl.define do
  sequence :ext_team_id do |n|
    "ABC#{n}-TEAM-IJKL"
  end

  factory :team do
    name "MyString"
    teamalias "MyString"
    ext_team_id
  end
end
