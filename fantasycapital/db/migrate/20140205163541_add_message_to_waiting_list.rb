class AddMessageToWaitingList < ActiveRecord::Migration
  def change
    add_column :waiting_lists, :message, :string
  end
end
