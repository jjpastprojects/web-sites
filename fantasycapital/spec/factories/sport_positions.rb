# == Schema Information
#
# Table name: sport_positions
#
#  id               :integer          not null, primary key
#  name             :string(255)
#  sport            :string(255)
#  display_priority :integer
#  created_at       :datetime
#  updated_at       :datetime
#  visible          :boolean          default(TRUE)
#

# Read about factories at https://github.com/thoughtbot/factory_girl

FactoryGirl.define do
  factory :sport_position do
    # only create 6 sports positions.
    sequence (:id) { |n| n % 6 }
    sport "NBA"
    # use actual position names and priorities from NBA; mix them up to make sure we sort properly
    sequence (:name) { |n| ["SG", "SF", "C", "PG", "UTIL", "PF"].at(n % 6)}
    sequence (:display_priority) { |n| [2, 3, 5, 1, 0, 4].at(n % 6)}
  end
end
