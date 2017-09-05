# == Schema Information
#
# Table name: waiting_lists
#
#  id               :integer          not null, primary key
#  email            :string(255)
#  name             :string(255)
#  created_at       :datetime
#  updated_at       :datetime
#  invited_by_token :string(255)
#  invitation_token :string(255)
#  status           :integer          default(1)
#  user_id          :integer
#  message          :string(255)
#

FactoryGirl.define do
  factory :waiting_list do
    email { generate :email }
    user nil
  end
end
