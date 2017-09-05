# == Schema Information
#
# Table name: teams
#
#  id          :integer          not null, primary key
#  name        :string(255)
#  teamalias   :string(255)
#  ext_team_id :string(255)
#  created_at  :datetime
#  updated_at  :datetime
#

class Team < ActiveRecord::Base
  validates :ext_team_id, uniqueness: true
  has_many :players

  class << self

    def refresh_all(teams_src)
      # create teams in database if they're missing
      teams_src.each do |team|
        Team.where(ext_team_id: team['id']).first_or_create do |created_team|
          created_team.name = "#{team['market']} #{team['name']}"
          created_team.teamalias = team['alias']
        end
      end
    end
  end

end
