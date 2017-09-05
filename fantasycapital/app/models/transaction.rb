# == Schema Information
#
# Table name: transactions
#
#  id                    :integer          not null, primary key
#  amount_in_cents       :integer
#  transaction_type      :integer
#  user_id               :integer
#  parent_transaction_id :integer
#  payment_engine_type   :integer
#  payment_engine_id     :string(255)
#  notes                 :text
#  created_at            :datetime
#  updated_at            :datetime
#  entry_id              :integer
#

class Transaction < ActiveRecord::Base
  belongs_to :user, inverse_of: :transactions
  belongs_to :entry, inverse_of: :transaction

  belongs_to :parent, :class_name => "Transaction", :foreign_key => "parent_transaction_id"
  has_many :child_transactions, :class_name => "Transaction", :foreign_key => "parent_transaction_id"


  # Create a random transaction
  def self.random_transaction(current_user, force_transaction_type=nil)
    ttype = rand(1..self.TYPE_ENUM.length)
    if force_transaction_type != nil
      ttype = force_transaction_type
    end
    amt = rand(0..10000)
    rx = Transaction.new

    case ttype
    when 1..2
      rx.payment_engine_type = self.PAYMENT_ENGINE_TYPE_ENUM[:stripe]
      rx.payment_engine_id = rand(100000..10000000)
      rx.user_id = current_user.id
      if ttype == 2
        amt = amt * -1
      end
    when 3..5
      return nil
    when 6..7
      rx.payment_engine_type = self.PAYMENT_ENGINE_TYPE_ENUM[:stripe]
      rx.payment_engine_id = rand(100000..10000000)
      if ttype == 6
        amt = amt * -1
      end
    end
    rx.transaction_type = ttype
    rx.amount_in_cents = amt
    return rx      
  end


  # The different types of payments engines as integers
  @@PAYMENT_ENGINE_TYPE_ENUM = {
    :stripe => 1,
  }
  def self.PAYMENT_ENGINE_TYPE_ENUM
    return @@PAYMENT_ENGINE_TYPE_ENUM
  end


  # The different types of transactions as integers
  @@TYPE_ENUM = {
    :charge => 1,
    :transfer => 2,
    :contest_entry => 3,
    :contest_winnings => 4,
    :contest_rake => 5,
    :op_fee => 6,
    :op_settlement => 7
  }
  def self.TYPE_ENUM
    return @@TYPE_ENUM
  end

  # Get the symbol name of the type specified by the integer
  def get_type_name
    @@TYPE_ENUM.keys.each do |kkk|
      if @@TYPE_ENUM[kkk] == self.transaction_type
        return kkk
      end
    end
    return nil
  end
end
