class AddDobToPlayers < ActiveRecord::Migration
  def change
    add_column :players, :dob, :date
    remove_column :players, :age
  end
end
