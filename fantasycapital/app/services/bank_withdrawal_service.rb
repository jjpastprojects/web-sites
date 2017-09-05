MIN_WITHDRAWAL_AMOUNT = 20

class BankWithdrawalService

  def initialize(user, bank)
    @user = user
    @bank = bank
  end

  def withdraw(amount)

    if amount < MIN_WITHDRAWAL_AMOUNT
      raise ServiceError, "You must withdraw at least $#{MIN_WITHDRAWAL_AMOUNT}"
    end

    cents = amount * 100

    # Stripe says they only charge $0.25 for fees for transfers so this is 
    # what we assume
    stripe_transfer_fee = 25

    new_transaction = Transaction.new
    op_transaction = Transaction.new
    begin
      ActiveRecord::Base.transaction do     
        # First create an internal transfer transaction with the amount
        # specified to make sure user has enough funds.
        new_transaction.user_id = @user.id
        new_transaction.transaction_type = Transaction.TYPE_ENUM[:transfer]
        new_transaction.payment_engine_type = 
          Transaction.PAYMENT_ENGINE_TYPE_ENUM[:stripe]
        new_transaction.amount_in_cents = cents * -1
        new_transaction.save!

        # Create an op transaction for the assumed stripe fee
        op_transaction.transaction_type = Transaction.TYPE_ENUM[:op_fee]
        op_transaction.amount_in_cents = stripe_transfer_fee * -1
        op_transaction.save! 

        # This op fee transaction belongs to the transfer transaction
        new_transaction.child_transactions << op_transaction
      end
    rescue
      # Something bad happened, transaction didn't persist
      raise ServiceError, "Bank transfer failed!"
    end
      

    # This rescue block basically will back out the new_transaction 
    # and op_transaction if anything fails.
    begin
      # Assuming user does transfer, does user have enough money to withdraw?
      if 0 > @user.account_balance 
        raise ServiceError, 'Insufficient Funds'
      end

      # OK user has enough money, check if escrow has enough to give to user
      escrow_balance = Stripe::Balance.retrieve()

      if escrow_balance.available[0].amount < cents
        # Settle op fees - this should get balance positive
        OpSettlementService.new().run()

        # Retry
        escrow_balance = Stripe::Balance.retrieve()
        if escrow_balance.available[0].amount < cents
          # What still not enough? Something catastrophic happened?!
          Rails.logger.error "Transfer failed because FC Opp Settlement could not resolve into a positive balance"

          # JACKPIEN - need to handle this more gracefully cause user
          # will be super pissed if they can't get their money
          raise ServiceError, "Transfer failed."
        end      
      end

      # Do the transfer for real
      tr = Stripe::Transfer.create(
        amount: cents,
        currency: 'usd',
        recipient: @bank.recipient_id,
        statement_description: 'Fantasy Capital Bank Transfer'
      )

      if tr.status == "failed"
        raise ServiceError, "Error making withdrawal with Stripe"
      end

      begin
        ActiveRecord::Base.transaction do        
          # Store away stripe id for this transaction
          new_transaction.payment_engine_id = tr.id
          new_transaction.save!

          # Double check the fees
          stripe_balance_transaction_id = tr.balance_transaction
          balance_transaction = Stripe::BalanceTransaction.retrieve(stripe_balance_transaction_id)
          actual_fees_paid = balance_transaction.fee

          if actual_fees_paid != stripe_transfer_fee
            Rails.logger.error "Assumed transfer fee not the same as what we actually paid. Why?? #{actual_fees_paid} vs #{stripe_transfer_fee} cents"

            # Difference
            fee_diff = actual_fees_paid - stripe_transer_fee
            if fee_diff > 0
              # Create another op_transaction to cover difference
              op_tr = Transaction.new
              op_tr.transaction_type = Transaction.TYPE_ENUM[:op_fee]
              op_tr.amount_in_cents = fee_diff * -1
              op_tr.save! 

              # This op fee transaction belongs to the transfer transaction
              new_transaction.child_transactions << op_tr
            end            
          end
        end
      rescue
        # Something bad happened, transaction didn't persist
        # need to cancel the transfer
        tr.cancel
        raise ServiceError, "Deposit failed!"
      end

    rescue => ex
      # JACKPIEN - Bugbug - There is a small likelihood that something fails
      # and triggers an exception after we ran a "daily sweep" /
      # opp_settlement_service - of which FC Opps would have paid the 
      # Op Transaction of the assumed 25 cent fee to escrow.  This will 
      # cause an accounting in balance where Escrow will have more money than 
      # one would think.  Mitigating this situation by creating an error
      # statement here and cross referencing with the logging of 
      # opp_settlement_service runs.  
      # 
      # In summary, this case occurs if a withdrawal request from user 
      # causes an 
      # opp_settlement_service call (pretty unlikely) and then further down 
      # the line, something bad happens and we need to back everything out
      # (also equally unlikely).
      Rails.logger.error ex.message
      Rails.logger.error ex.backtrace.join("\n")
      Rails.logger.error "Something failed after we started down executing a bank withdrawal. Need to make sure a opp_settlement_service wasn't triggered which will cause escrow to have more money than it should."

      new_transaction.destroy
      op_transaction.destroy
      raise ex
    end

  end
end
