class AddPriorityToOrderStatuses < ActiveRecord::Migration
  def change
    add_column :order_statuses, :priority, :integer, null: false, default: 999
  end
end
