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

# Read about factories at https://github.com/thoughtbot/factory_girl

FactoryGirl.define do
  factory :projection_projection_breakdown, :class => 'Projection::ProjectionBreakdown' do
    proj_by_stat_crit nil
    stat nil
  end
end
