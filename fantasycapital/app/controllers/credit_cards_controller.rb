class CreditCardsController < ApplicationController

  def create
    begin
      card_service = CardService.new(current_user)
      StripeCustomerService.new(current_user, params[:stripe_token]).ensure!

      unless card_service.add(credit_card_params)
        render_json_errors(card_service.credit_card)
        return
      end

      if params[:amount].present?
        amount = params[:amount].gsub(/\D/, '').to_i
        DepositService.new(current_user).deposit(amount)
      end

      render json: {status: 201}

    rescue ServiceError => e
      render json: {error: e.message}, status: :unprocessable_entity
    rescue => e
      Rails.logger.error "Unable to add credit card: #{e.message}"
      render json: {error: "Unable to add credit card"}, status: :unprocessable_entity
    end
  end

  def deposit
    begin
      amount = (params[:amount]||'0').gsub(/\D/, '').to_i
      DepositService.new(current_user).deposit(amount)
      render json: {status: 201}
    rescue ServiceError => e
      render json: {error: e.message}, status: :unprocessable_entity
    rescue 
      render json: {error: "Unable to deposit funds"}, status: :unprocessable_entity
    end
  end


  private

  def credit_card_params
     params.require(:credit_card).permit(:stripe_id, :card_brand, :last_4)
  end
end
