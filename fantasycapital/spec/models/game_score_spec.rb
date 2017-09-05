# == Schema Information
#
# Table name: game_scores
#
#  id              :integer          not null, primary key
#  playdate        :date
#  ext_game_id     :string(255)
#  scheduledstart  :datetime
#  home_team_id    :integer
#  away_team_id    :integer
#  home_team_score :integer
#  away_team_score :integer
#  status          :string(255)
#  clock           :integer
#  period          :integer
#  created_at      :datetime
#  updated_at      :datetime
#  sport           :string(255)      default("NBA")
#

require 'spec_helper'

describe GameScore do
  let!(:games) {[create(:game_score, playdate:"2014-03-12", scheduledstart: "2014-03-12 5:00"),
                 create(:game_score, playdate:"2014-03-12", scheduledstart: "2014-03-12 9:00"),
                 create(:game_score, playdate:"2014-03-11", scheduledstart: "2014-03-11 4:00"),
                 ]}
  context "When three games are scheduled" do
    it "Earliest start time is correct" do
      # note this fields are all converted to TimeWithZone, in UTC time.
      expect(GameScore.earliest_start("2014-03-12")).to eq("2014-03-12 5:00")
      expect(GameScore.earliest_start("2014-03-11")).to eq("2014-03-11 4:00")
    end
    it "Earliest start time of a day without games is nil" do
      expect(GameScore.earliest_start("2014-03-10")).to be(nil)

    end


  end

end
