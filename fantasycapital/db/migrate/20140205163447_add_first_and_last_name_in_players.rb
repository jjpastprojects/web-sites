class AddFirstAndLastNameInPlayers < ActiveRecord::Migration
  def change
    add_column :players, :stats_id, :integer
    add_index :players, :stats_id

    add_column :players, :first_name, :string
    add_column :players, :last_name, :string
    remove_column :players, :name
  end
end
