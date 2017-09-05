# == Schema Information
#
# Table name: credit_cards
#
#  id         :integer          not null, primary key
#  stripe_id  :string(255)
#  is_default :boolean
#  card_brand :string(255)
#  last_4     :string(255)
#  user_id    :integer
#  created_at :datetime
#  updated_at :datetime
#

# Even thoug this is called credit card we only maintain the stripe ID
# and the last 4 digits of the card. The real numbers never touch our servers
class CreditCard < ActiveRecord::Base
  belongs_to :user
  validates :stripe_id, presence: true
  validates :last_4, presence: true
  validates :card_brand, presence: true
end
