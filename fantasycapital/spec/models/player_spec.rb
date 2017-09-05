# == Schema Information
#
# Table name: players
#
#  id                :integer          not null, primary key
#  created_at        :datetime
#  updated_at        :datetime
#  sport_position_id :integer
#  salary            :integer
#  first_name        :string(255)
#  last_name         :string(255)
#  dob               :date
#  ext_player_id     :string(255)
#  team_id           :integer
#

require 'spec_helper'

describe Player do
  let(:positions) { create_list(:sport_position, 6)}
  let(:player) { create(:player, sport_position: positions[0]) }
  let(:teams) { create_list(:team, 4)}

  let!(:game) {create(:game_score, playdate:"2014-03-21", home_team: teams[0], away_team: teams[1])}
  let!(:game2) {create(:game_score, playdate:"2014-03-22", home_team: teams[0], away_team: teams[1])}

  let!(:rtscores) { [create(:player_real_time_score, player:player, game_score:game, name: "fp", value:20),
                     create(:player_real_time_score, player:player, game_score:game2, name: "fp", value:30),] }


  it "returns correct FP scores without eager-loading" do

    should belong_to(:sport_position)
    expect(player.realtime_fantasy_points(game)).to eq(20)
    expect(player.realtime_fantasy_points(game2)).to eq(30)
  end

  it "returns correct FP scores WITH eager-loading" do
    # For entering GameCenter, the entries_controller can eager-load all the player scores for the
    # current games.
    # Player model is sophisticated enough to detect this and skip the additional query. Check
    # this functionality by creating players with eager-loaded scores, then getting their points.

    myplayer = Player.includes(:player_real_time_scores).where(
        player_real_time_scores: {game_score_id: [game.id]})[0]

    expect(myplayer.realtime_fantasy_points).to eq(20)

    myplayer2 = Player.includes(:player_real_time_scores).where(
        player_real_time_scores: {game_score_id: [game2.id]})[0]

    expect(myplayer2.realtime_fantasy_points).to eq(30)
  end

end
