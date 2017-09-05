class BankService

  attr_reader :bank_account

  def initialize(user, stripe_token)
    @user = user
    @stripe_token = stripe_token
  end

  def add(bank_params, tax_id)
    @bank_account = @user.bank_accounts.build(bank_params)
    recipient = Stripe::Recipient.create(
      :name => @user.full_name, # This is the user's full legal name
      :type => "individual",
      :email => @user.email,
      :bank_account => @stripe_token,
      :tax_id => tax_id
    )

    begin
      ActiveRecord::Base.transaction do
        
        @user.bank_accounts.where(is_default: true).update_all(is_default: false)
        @bank_account.is_default = true
        @bank_account.recipient_id = recipient.id
        @bank_account.save!
      end
    rescue
      # Something bad happened, delete recipient
      recipient.delete
      Rails.logger.error "Add bank account failed"
      return false
    end
    return true
  end
end
