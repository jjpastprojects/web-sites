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

require 'spec_helper'

describe Account do
  describe 'balance_in_cents' do

    it 'nil balance should be zero' do
      Account.new.current_balance.should == 0.0
    end

    it 'returns correct balance' do
      Account.new(:balance_in_cents => 5000).current_balance.should == 50.0
    end
  end
end

