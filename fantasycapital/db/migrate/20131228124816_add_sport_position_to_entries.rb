class AddSportPositionToEntries < ActiveRecord::Migration
  def change
    add_reference :entries, :sport_position, index: true
  end
end
