module TransactionService
  def TransactionService.contest_entry( user, entry )
    # Will raise exception if contest entry fails

    # Already have an entry with this user?
    if Transaction.where(user: user, entry: entry).exists?
      raise ServiceError, "Already an entry associated with this user for a transaction service."
    end

    # Create new contest entry transaction
    new_tr = Transaction.new
    new_tr.user = user
    new_tr.entry = entry
    new_tr.transaction_type = Transaction.TYPE_ENUM[:contest_entry]
    new_tr.amount_in_cents = (entry.contest.entry_fee * -100.0).ceil
    new_tr.save! 

    # Make sure user has positive balance after entry
    if user.account_balance < 0.0
      # Back out transaction
      new_tr.delete
      raise ServiceError, "Not enough funds to enter contest"
    end
  end



  def TransactionService.contest_entry_cancel( user, entry )
    entry_tr = Transaction.where(user: user, entry: entry, transaction_type: Transaction.TYPE_ENUM[:contest_entry])
    
    # Should only be one transaction
    if entry_tr.count > 1
      Rails.logger.error "There happens to be more than one entry for this user: " + user.id.to_s + " for this contest: " + entry.contest.id.to_s
    end

    # Delete the entries
    entry_tr.each { |eee| eee.delete }
  end



  def TransactionService.contest_end( contest )
    # If exception was raised, no one was awarded prizes, ops did not 
    # receive rake
    winnings = contest.winnings

    # All in dollars
    prize_pool = contest.prizepool
    total_prize_given_in_cents = 0

    begin
      entry = nil
      ActiveRecord::Base.transaction do
        winnings.each do |www|
          entry = www[:entry]
          user = entry.lineup.user
          prize_fraction = www[:prize_fraction]
          prize_in_cents = (prize_pool * prize_fraction * 100.0).round
          
          # Create transaction
          new_tr = Transaction.new
          new_tr.user = user
          new_tr.entry = entry
          new_tr.transaction_type = Transaction.TYPE_ENUM[:contest_winnings]
          new_tr.amount_in_cents = (entry.contest.entry_fee * 100).ceil
          new_tr.save! 
          
          total_prize_given_in_cents += new_tr.amount_in_cents
        end

        # Create a rake transaction
        rake_in_cents = (contest.entry_fee * contest.max_entries * 100).round - total_prize_given_in_cents
        new_tr = Transaction.new

        # Just need an entry so we can trace back to a specific contest
        new_tr.entry = entry
        new_tr.transaction_type = Transaction.TYPE_ENUM[:contest_rake]
        new_tr.amount_in_cents = rake_in_cents
        new_tr.save! 
      end
      
    rescue => ex      
      Rails.logger.error ex.message
      Rails.logger.error ex.backtrace.join("\n")
      Rails.logger.error "Something failed during contest end transaction service"
      raise ServiceError, "Could not complete contest end transaction service."
    end
  end
end
