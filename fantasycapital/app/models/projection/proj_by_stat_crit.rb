# == Schema Information
#
# Table name: projection_proj_by_stat_crits
#
#  id                    :integer          not null, primary key
#  projection_by_stat_id :integer
#  fp                    :decimal(, )
#  weighted_fp           :decimal(, )
#  criteria              :string(255)
#  created_at            :datetime
#  updated_at            :datetime
#

class Projection::ProjByStatCrit < ActiveRecord::Base
  belongs_to :projection_by_stat
  has_many :projection_breakdowns, :dependent => :delete_all
end
