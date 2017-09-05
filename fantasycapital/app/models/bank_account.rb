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

class BankAccount < ActiveRecord::Base
  belongs_to :user
  validates :stripe_id, presence: true
  validates :last_4, presence: true
  validates :name, presence: true
  validates :recipient_id, presence: true
end
