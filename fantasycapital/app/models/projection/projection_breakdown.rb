# == Schema Information
#
# Table name: projection_projection_breakdowns
#
#  id                   :integer          not null, primary key
#  proj_by_stat_crit_id :integer
#  stat_id              :integer
#  created_at           :datetime
#  updated_at           :datetime
#

class Projection::ProjectionBreakdown < ActiveRecord::Base
  belongs_to :proj_by_stat_crit
  belongs_to :stat
end
