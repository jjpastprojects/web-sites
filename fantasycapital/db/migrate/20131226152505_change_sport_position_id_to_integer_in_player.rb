class ChangeSportPositionIdToIntegerInPlayer < ActiveRecord::Migration
  def change
    remove_column :players, :sport_position_id, :string
    add_column :players, :sport_position_id, :integer
  end
end
