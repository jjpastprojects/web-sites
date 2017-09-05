require 'spec_helper'
require 'stripe_mock'

describe StripeCustomerService do

  before { StripeMock.start }
  after { StripeMock.stop }

  let(:user) { FactoryGirl.create(:user) }
  let(:user_with_account) { FactoryGirl.create(:user_with_account) }
  let(:stripe_token) { 'stripe_12345' }

  describe 'ensure!' do

    it 'sets stripe id on user for valid token' do
      StripeCustomerService.new(user, stripe_token).ensure!
      user.account.should_not be_nil
    end

  end
end
