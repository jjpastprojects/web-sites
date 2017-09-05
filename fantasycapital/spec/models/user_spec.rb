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

require 'spec_helper'

describe User do

  let(:user) { FactoryGirl.create(:user) }

  it { should have_many(:lineups) }
  it { should have_many(:entries) }
  it { should have_many(:contests).through(:entries) }
  it { should have_one(:waiting_list) }
  it { should have_one(:account) }

  it { should validate_presence_of(:first_name) }
  it { should validate_presence_of(:last_name) }
  it { should have_many(:credit_cards) }
  it { should have_many(:bank_accounts) }

  describe 'default card' do

    it 'returns nil if no cards' do
      user.default_card.should == nil
    end

    it 'returns the first default credit card' do
      user.credit_cards << CreditCard.new(stripe_id: '1', card_brand: 'Visa', is_default: false, last_4: '1234')
      user.credit_cards << CreditCard.new(stripe_id: '2', card_brand: 'Visa', is_default: true, last_4: '5678')
      user.save!
      user.default_card.last_4.should == '5678'
    end

  end

  describe 'full_name' do
    it 'combines first and last names' do
      user.full_name.should == 'first last'
    end
  end

  describe 'account_balance' do

    it 'returns 0 if no user has no transactions, otherwise positive balance' do
      
      # JPIEN - Don't really need this piece of code, but it's here cause 
      # temporary transaction creation code in user.account_balance
      # will trigger the temp transaction creation code to trigger and 
      # fail the test unconditionally.  
      user.account_balance

      if user.transactions.length == 0
        user.account_balance.should == 0.0
      else
        user.account_balance.should > 0.0
      end
    end

    # JPIEN - TTD
    # Should write some transaction creating tests
  end
end
