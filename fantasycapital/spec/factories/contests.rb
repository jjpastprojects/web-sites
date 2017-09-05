# == Schema Information
#
# Table name: contests
#
#  id            :integer          not null, primary key
#  title         :string(255)
#  sport         :string(255)
#  contest_type  :string(255)
#  entry_fee     :decimal(, )
#  contest_start :datetime
#  created_at    :datetime
#  updated_at    :datetime
#  max_entries   :integer
#  entries_count :integer          default(0)
#  contestdate   :date
#  rake          :float            default(0.1)
#

# Read about factories at https://github.com/thoughtbot/factory_girl

FactoryGirl.define do
  factory :contest do
    sport "NBA"
    contest_type "50/50"
    entry_fee 1.0
    rake 0.1
    contestdate "2014-03-12"
    max_entries 10
  end
end
