# == Schema Information
#
# Table name: users
#
#  id                     :integer          not null, primary key
#  email                  :string(255)      default(""), not null
#  encrypted_password     :string(255)      default(""), not null
#  reset_password_token   :string(255)
#  reset_password_sent_at :datetime
#  remember_created_at    :datetime
#  sign_in_count          :integer          default(0), not null
#  current_sign_in_at     :datetime
#  last_sign_in_at        :datetime
#  current_sign_in_ip     :string(255)
#  last_sign_in_ip        :string(255)
#  created_at             :datetime
#  updated_at             :datetime
#  first_name             :string(255)
#  last_name              :string(255)
#  balanced_customer_id   :string(255)
#  balance                :integer          default(0)
#  username               :string(255)
#  country                :string(255)
#  state                  :string(255)
#  admin                  :boolean          default(FALSE)
#

# Read about factories at https://github.com/thoughtbot/factory_girl
FactoryGirl.define do
  sequence :email do |n|
    "user#{n}@example.com"
  end

  sequence :username do |n|
    "username#{n}"
  end
end

FactoryGirl.define do
  factory :user do
    first_name "first"
    last_name "last"
    password "password"
    email { generate :email }
    username { generate :username }
    country "US"
    state "AL"

    after(:create) do |user|
      create(:transaction, user: user, 
             transaction_type: Transaction.TYPE_ENUM[:charge], 
             amount_in_cents: 100000, 
             payment_engine_type: Transaction.PAYMENT_ENGINE_TYPE_ENUM[:stripe])
    end

    factory :user_with_account  do
      account
    end
  end
end
