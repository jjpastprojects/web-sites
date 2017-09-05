class AddTeamReferencesToPlayer < ActiveRecord::Migration
  def change
    add_reference :projection_players, :team, index: true
  end
end
