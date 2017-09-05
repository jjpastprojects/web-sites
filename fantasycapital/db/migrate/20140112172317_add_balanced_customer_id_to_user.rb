class AddBalancedCustomerIdToUser < ActiveRecord::Migration
  def change
    add_column :users, :balanced_customer_id, :string
  end
end
