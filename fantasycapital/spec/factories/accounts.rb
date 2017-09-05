# == Schema Information
#
# Table name: accounts
#
#  id                 :integer          not null, primary key
#  user_id            :integer
#  created_at         :datetime
#  updated_at         :datetime
#  stripe_customer_id :string(255)
#  balance_in_cents   :integer          default(0)
#  lock_version       :integer          default(0)
#

# Read about factories at https://github.com/thoughtbot/factory_girl
FactoryGirl.define do
  factory :account do
    stripe_customer_id 'cus_123'
    balance_in_cents 0
  end
end
