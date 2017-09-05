class AddInvitedByAndInvitationCodeToWaitingLists < ActiveRecord::Migration
  def change
    add_column :waiting_lists, :invited_by_token, :string
    add_column :waiting_lists, :invitation_token, :string

    add_index :waiting_lists, :invitation_token
    add_index :waiting_lists, :invited_by_token
  end
end
