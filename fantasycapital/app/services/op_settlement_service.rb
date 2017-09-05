class OpSettlementService

  def initialize()
  end

  
  # This routine will be run any time we need to settle outstanding balances
  # with FC Ops.  This could include Escrow owing FC Ops rake money and/or
  # FC Ops owing Ecrow money for fees.  
  #
  # As a rule of thumb we will run this daily to settle ops balances or
  # anytime there is sort of an "escrow" run where ppl want to transfer
  # their money out of escrow and Ops will need to pay off the Stripe
  # transaction fees to do so. 
  def run
    # Create a new op settlement just to get a timestamp
    new_op = Transaction.new
    new_op.transaction_type = Transaction.TYPE_ENUM[:op_settlement]
    new_op.amount_in_cents = 0
    new_op.save! 

    # List of op_fees and rakes
    op_fee_list = []
    contest_rake_list = []

    # Go back in time to find the last op settlement
    last_op = Transaction.where("created_at < :end_date AND transaction_type = #{Transaction.TYPE_ENUM[:op_settlement]}", 
                                {end_date: new_op.created_at}).order( created_at: :desc ).first

    # Never created an op settlement
    start_date = nil
    if last_op == nil
      start_date = Transaction.order(created_at: :asc).first.created_at
    else
      start_date = last_op.created_at
    end
      
    op_fee_list = Transaction.where("created_at < :end_date AND created_at >= :st_date AND transaction_type = #{Transaction.TYPE_ENUM[:op_fee]}", 
                                    {end_date: new_op.created_at, st_date: start_date})

    contest_rake_list = Transaction.where("created_at < :end_date AND created_at >= :st_date AND transaction_type = #{Transaction.TYPE_ENUM[:contest_rake]}", 
                                          {end_date: new_op.created_at, st_date: start_date})
      
    # Let's figure out how much FC ops needs to cover
    sum_in_cents = 0
    puts "here!! " + op_fee_list.count.to_s
    op_fee_list.each do |tr|
      sum_in_cents += tr.amount_in_cents
    end
    contest_rake_list.each do |tr|
      sum_in_cents += tr.amount_in_cents
    end

    stripe_transfer_fee_in_cents = 25
    stripe_charge_fee_in_cents = 30
    stripe_charge_fee_pct = 0.029
    stripe_charge = nil
    stripe_transfer = nil

    begin
      if sum_in_cents > 0
        # Create a transfer to FC ops minus the fees
        amt_minus_fee_in_cents = sum_in_cents - stripe_transfer_fee_in_cents

        if amt_incl_fee_in_cents < 100
          raise ServiceError, "Transfer to FC Ops is too little: " + amt_minus_fee_in_cents.to_s
        end

        # Make transfer!      
        stripe_transfer = 
          Stripe::Transfer.create(
             amount: amt_minus_fee_in_cents,
             currency: 'usd',
             recipient: Rails.configuration.stripe[:fc_op_stripe_recipient_id],
             statement_description: 'Fantasy Capital Ops Settlement: ' + new_op.id.to_s )

        if stripe_transfer.status == "failed"
          raise ServiceError, "Error making withdrawal with Stripe"
        end

      else
        # Create charge amount which includes fees
        # AMT = [sum_in_cents / (1-charge_pct)] + fixed_fee
        # NOTE: Stripe seems to charge fee pct with the fixed fee included?!
        amt_incl_fee_in_cents = (sum_in_cents - stripe_charge_fee_in_cents) * (1.0/(1.0-stripe_charge_fee_pct))
        amt_incl_fee_in_cents *= -1

        # Always round up so escrow has positive balance
        amt_incl_fee_in_cents = amt_incl_fee_in_cents.ceil

        if amt_incl_fee_in_cents < 100
          raise ServiceError, "Charge to FC Ops is too little: " + amt_incl_fee_in_cents.to_s
        end
        
        # Make charge!
        stripe_charge = Stripe::Charge.create(
          customer: Rails.configuration.stripe[:fc_op_stripe_customer_id],
          amount: amt_incl_fee_in_cents,
          description: 'Fantasy Capital Ops Settlement: ' + new_op.id.to_s,
          currency: 'usd' )

        if stripe_charge.paid == false
          raise ServiceError, "Error making deposit with Stripe - #{stripe_charge.failure_message}"
        end

      end
      ActiveRecord::Base.transaction do
        new_op.amount_in_cents = sum_in_cents
        new_op.save!

        op_fee_list.each do |tr|
          new_op.child_transactions << tr
        end
        contest_rake_list.each do |tr|
          new_op.child_transactions << tr
        end        
      end
    rescue => ex
      Rails.logger.error ex.message
      Rails.logger.error ex.backtrace.join("\n")
      Rails.logger.error "Something failed during a Op Settlement run"

      # Something bad happened
      if stripe_transfer != nil && stripe_transfer.status != "failed"
        stripe_transfer.cancel
      end
      
      if stripe_charge != nil && stripe_charge.paid == true
        stripe_charge.refund
      end

      new_op.delete
    end
  end


end
