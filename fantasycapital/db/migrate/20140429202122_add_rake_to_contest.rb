class AddRakeToContest < ActiveRecord::Migration
  def change
    add_column :contests, :rake, :float, default: 0.1
    remove_column :contests, :prize
  end
end
