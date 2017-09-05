class RenamePositionToSportPositionIdInPalyer < ActiveRecord::Migration
  def change
    rename_column :players, :position, :sport_position_id
  end
end
