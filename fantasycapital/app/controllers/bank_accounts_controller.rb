class BankAccountsController < ApplicationController

  def withdrawal
    @bank_account = current_user.bank_accounts.first
  end

  def withdrawal_post
    begin
      if params[:amount].present?
        bank_account = current_user.bank_accounts.where(is_default: true).first
        amount = params[:amount].gsub(/\D/, '').to_i
        BankWithdrawalService.new(current_user, bank_account).withdraw(amount)
      end   
    rescue ServiceError => e
      render json: {error: e.message}, status: :unprocessable_entity
      return
    rescue => e
      render json: {error: "Could not withdraw funds from default bank account"}, status: :unprocessable_entity
      return
    end

    render json: nil, status: :ok
  end

  def new
  end

  def create
    begin
      stripe_token = params[:stripe_token]
      bank_service = BankService.new(current_user, stripe_token)

      unless bank_service.add(bank_account_params, params[:tax_id])
        render_json_errors(bank_service.bank_account)
        return
      end
    rescue ServiceError => e
      render json: {error: e.message}, status: :unprocessable_entity
      return
    rescue
      render json: {error: "Unable to add bank account"}, status: :unprocessable_entity
      return
    end

    render json: {status: 201}

  end

  private

  def bank_account_params
    params.require(:bank_account).permit(:stripe_id, :name, :last_4)
  end
end
