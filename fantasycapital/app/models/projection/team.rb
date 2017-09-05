# == Schema Information
#
# Table name: projection_teams
#
#  id          :integer          not null, primary key
#  name        :string(255)
#  created_at  :datetime
#  updated_at  :datetime
#  is_current  :boolean
#  ext_team_id :string(255)
#

module Projection
  class Team < ActiveRecord::Base
    has_many :games, inverse_of: :team
    has_many :players, inverse_of: :team
    validates :ext_team_id, uniqueness: true

    class << self
      def refresh_all(teams_src)
        Team.update_all(is_current: false)
        updated_teams = []
        teams_src.each do |team_src|
          team = Team.where(ext_team_id: team_src["id"]).first_or_create
          team.name = team_src["name"]
          team.is_current = true;
          team.save!
          updated_teams << team
        end
        updated_teams
      end
    end

  end
end
