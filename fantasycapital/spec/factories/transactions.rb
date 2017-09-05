# == Schema Information
#
# Table name: transactions
#
#  id                    :integer          not null, primary key
#  amount_in_cents       :integer
#  transaction_type      :integer
#  user_id               :integer
#  parent_transaction_id :integer
#  payment_engine_type   :integer
#  payment_engine_id     :string(255)
#  notes                 :text
#  created_at            :datetime
#  updated_at            :datetime
#  entry_id              :integer
#

# Read about factories at https://github.com/thoughtbot/factory_girl

FactoryGirl.define do
  factory :transaction do
    amount_in_cents 1
    transaction_type 1
    user_id 1
    parent_transaction_id 1
    payment_engine_type 1
    payment_engine_id "MyString"
    notes "MyText"
  end
end
