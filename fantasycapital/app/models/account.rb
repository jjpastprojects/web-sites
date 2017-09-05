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

class Account < ActiveRecord::Base
  belongs_to :user
  validates :stripe_customer_id, presence: true

  def current_balance
    self.balance_in_cents / 100.0
  end
end
