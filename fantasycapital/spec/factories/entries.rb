# == Schema Information
#
# Table name: entries
#
#  id          :integer          not null, primary key
#  lineup_id   :integer
#  created_at  :datetime
#  updated_at  :datetime
#  contest_id  :integer
#  final_score :decimal(, )
#  final_pos   :integer
#

# Read about factories at https://github.com/thoughtbot/factory_girl

FactoryGirl.define do
  factory :entry do
    contest nil
    lineup nil
  end
end
