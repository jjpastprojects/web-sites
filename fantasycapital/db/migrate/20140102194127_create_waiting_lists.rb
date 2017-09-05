class CreateWaitingLists < ActiveRecord::Migration
  def change
    create_table :waiting_lists do |t|
      t.string :email
      t.string :name

      t.timestamps
    end
  end
end
