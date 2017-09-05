# == Schema Information
#
# Table name: bank_accounts
#
#  id           :integer          not null, primary key
#  name         :string(255)
#  stripe_id    :string(255)
#  last_4       :string(255)
#  user_id      :integer
#  created_at   :datetime
#  updated_at   :datetime
#  recipient_id :string(255)
#  is_default   :boolean
#

FactoryGirl.define do
  factory :bank_account do
    name 'test bank'
    last_4 '1234'
    recipient_id 'r123'
    stripe_id 's123'
  end
end
