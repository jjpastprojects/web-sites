class AddStatsTeamIdToTeam < ActiveRecord::Migration
  def change
    add_column :projection_teams, :stats_team_id, :integer
    add_column :projection_teams, :is_current, :boolean
  end
end
