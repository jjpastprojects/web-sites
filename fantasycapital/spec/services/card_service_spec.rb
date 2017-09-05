require 'spec_helper'

describe CardService do
  let(:user_with_account) { FactoryGirl.create(:user_with_account) }

  describe 'add' do
    it 'marks first card as default' do
      card_service = CardService.new(user_with_account)
      result = card_service.add({
        stripe_id: 'cc123',
        last_4: '1234',
        card_brand: 'Visa'
      })

      result.should == true
      card_service.credit_card.should_not be_nil
      user_with_account.credit_cards.length.should == 1
      user_with_account.credit_cards.first.is_default.should == true
    end
  end
end
