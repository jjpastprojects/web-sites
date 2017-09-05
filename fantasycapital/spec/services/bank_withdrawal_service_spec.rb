require 'spec_helper'
require 'stripe_mock'

describe BankWithdrawalService do

  before { StripeMock.start }
  after { StripeMock.stop }

  let(:user) { FactoryGirl.create(:user_with_account) }

  describe 'withdraw' do

    it 'throws error if amount does not meet minimum' do
      expect {
        BankWithdrawalService.new(user, nil).withdraw(19)
      }.to raise_error(ServiceError, 'You must withdraw at least $20')
    end

    it 'throws error if user does not have enough' do
      bal = user.account_balance

      expect {
        BankWithdrawalService.new(user, nil).withdraw(bal + 100)
      }.to raise_error(ServiceError, 'Insufficient Funds')
    end

    # JPIEN - Need to add relevant test for bank withdrawals using 
    # transactions when the time comes.
    #it 'updates users balance on success' do
    #  user.account.balance_in_cents = 10000
    #  user.bank_accounts << FactoryGirl.create(:bank_account)
    #  user.account.save!
    #  BankWithdrawalService.new(user, user.bank_accounts.first).withdraw(75)
    #  user.account_balance.should == 25
    #end
  end
end
