# == Schema Information
#
# Table name: projection_projection_by_stats
#
#  id            :integer          not null, primary key
#  stat_name     :string(255)
#  fp            :decimal(, )
#  weighted_fp   :decimal(, )
#  projection_id :integer
#  created_at    :datetime
#  updated_at    :datetime
#

module Projection
  class ProjectionByStat < ActiveRecord::Base
    belongs_to :projection
    has_many :proj_by_stat_crit, :dependent => :delete_all
  end
end
