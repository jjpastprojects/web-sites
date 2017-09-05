# == Schema Information
#
# Table name: lineups
#
#  id         :integer          not null, primary key
#  user_id    :integer
#  created_at :datetime
#  updated_at :datetime
#  sport      :string(255)
#

class Lineup < ActiveRecord::Base
  has_many :entries, inverse_of: :lineup
  has_many :lineup_spots, inverse_of: :lineup, dependent: :destroy
  has_many :players, through: :lineup_spots
  belongs_to :user, inverse_of: :lineups

  before_save :mark_unused_spot_for_removal

  accepts_nested_attributes_for :lineup_spots, allow_destroy: true

  #virtual attribute: enter a contest immediately after creation
  attr_accessor :contest_id_to_enter

  validate :salary_cap_validate
  validate :sport_positions_validate

  def salary_cap_validate
    #errors.add(:sport, "bogus error")
  end

  def sport_positions_validate
    #errors.add(:sport, "bogus error2")

  end

  # NILS: BUGBUG: Remove this?
  def completed?
    entries[0].present? && entries[0].contest.complete?
  end

  class << self
    def build_for_contest(contest, lineup = nil)
      # create empty LineupSpots and a Lineup object for a new lineup.
      lineup = Lineup.find_by_id(lineup) || Lineup.new
      lineup.sport = contest.sport
      lineup.contest_id_to_enter = contest.id

      LineupSpotProto.where(sport: contest.sport).order(spot: :asc).each do |proto|
        if lineup.lineup_spots.find_by_spot(proto.spot).blank?
          lineup.lineup_spots.build sport_position: SportPosition.find_by_sport_and_name(proto.sport, proto.sport_position_name), spot: proto.spot
        end
      end

      lineup
    end

  end

  protected
  def mark_unused_spot_for_removal
    lineup_spots.each do |spot|
      spot.mark_for_destruction if spot.player.blank?
    end
  end
end
