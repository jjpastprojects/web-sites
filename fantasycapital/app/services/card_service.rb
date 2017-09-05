# Handles adding new credit cards to an existing customer account cards
class CardService

  attr_reader :credit_card

  def initialize(user)
    @user = user
  end

  def add(card_params)
    begin
      ActiveRecord::Base.transaction do        
        @user.credit_cards.where(is_default: true).update_all(is_default: false)
        @credit_card = @user.credit_cards.build(card_params)
        @credit_card.is_default = true
        @credit_card.save!
      end
    rescue
      Rails.logger.error "Add credit card failed"
      return false
    end
    return true
  end
end
