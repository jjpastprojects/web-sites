MIN_DEPOSIT_AMOUNT = 20
MAX_DEPOSIT_AMOUNT = 2000

class DepositService

  def initialize(user)
    @user = user
  end

  def deposit(amount)
    validate_amount!(amount)
    amount = amount * 100 # Needs to be in cents

    charge = Stripe::Charge.create(
      customer: @user.account.stripe_customer_id,
      amount: amount,
      description: 'Fantasy Capital Deposit',
      currency: 'usd'
    )

    if charge.paid == false
      raise ServiceError, "Error making deposit with Stripe - #{charge.failure_message}"
    end

    begin
      ActiveRecord::Base.transaction do
        # Create new charge transaction for user    
        new_transaction = Transaction.new
        new_transaction.user_id = @user.id
        new_transaction.transaction_type = Transaction.TYPE_ENUM[:charge]
        new_transaction.payment_engine_type = 
          Transaction.PAYMENT_ENGINE_TYPE_ENUM[:stripe]
        new_transaction.payment_engine_id = charge.id
        new_transaction.amount_in_cents = charge.amount
        new_transaction.save!

        # Create an op fees transaction so that FC Opp can pay for the fees
        # associated with this charge
        stripe_balance_transaction_id = charge.balance_transaction
        balance_transaction = Stripe::BalanceTransaction.retrieve(stripe_balance_transaction_id)
        fees_paid = balance_transaction.fee

        op_transaction = Transaction.new
        op_transaction.transaction_type = Transaction.TYPE_ENUM[:op_fee]
        op_transaction.amount_in_cents = fees_paid * -1
        op_transaction.save! 

        # This op fee transaction belongs to the charge transaction
        new_transaction.child_transactions << op_transaction
      end
    rescue
      # Something bad happened, transaction didn't persist
      # need to refund the charge
      charge.refund
      raise ServiceError, "Deposit failed!"
    end
  end

  private

  def validate_amount!(amount)
    unless amount >= MIN_DEPOSIT_AMOUNT && amount <= MAX_DEPOSIT_AMOUNT
      raise ServiceError, "Amount must be between $#{MIN_DEPOSIT_AMOUNT} - $#{MAX_DEPOSIT_AMOUNT}"
    end
  end

end
