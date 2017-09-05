class ChangeTeamToReferenceInPlayer < ActiveRecord::Migration
  def up
      remove_column :players, :team
      add_column :players, :team_id, :integer
  end

  def down
      add_column :players, :team, :string
      remove_column :players, :team_id, :integer
  end
end
