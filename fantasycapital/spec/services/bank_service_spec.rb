require 'spec_helper'
require 'stripe_mock'

describe BankService do

  before { StripeMock.start }
  after { StripeMock.stop }

  let(:user) { FactoryGirl.create(:user_with_account) }

  describe 'add' do
    it 'returns false if invalid' do
      BankService.new(user, 's123').add({}, "").should == false
    end

    it 'saves valid bank account' do
      service = BankService.new(user, 's123')
      result = service.add({
        name: 'CIBC',
        last_4: '1234',
        stripe_id: 'ba_123'
      }, "0000000000")
      result.should == true
      service.bank_account.valid?.should == true
    end
  end
end
