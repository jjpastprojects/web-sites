# == Schema Information
#
# Table name: lineup_spot_protos
#
#  id                  :integer          not null, primary key
#  sport               :string(255)
#  sport_position_name :string(255)
#  spot                :integer
#  created_at          :datetime
#  updated_at          :datetime
#

# Read about factories at https://github.com/thoughtbot/factory_girl

FactoryGirl.define do
  factory :lineup_spot_proto do
    sport "MyString"
    sport_position_name "MyString"
    spot 1
  end
end
