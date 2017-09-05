class AddStatusToWaitingLists < ActiveRecord::Migration
  def change
    add_column :waiting_lists, :status, :integer, default: WaitingList::InvitationStatus::WAITING
    add_index :waiting_lists, :status
    add_reference :waiting_lists, :user
  end
end
