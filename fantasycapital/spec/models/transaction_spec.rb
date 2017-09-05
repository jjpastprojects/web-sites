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

require 'spec_helper'

describe Transaction do
  pending "add some examples to (or delete) #{__FILE__}"
end
