# == Schema Information
#
# Table name: player_real_time_scores
#
#  id            :integer          not null, primary key
#  name          :string(255)
#  value         :decimal(, )
#  player_id     :integer
#  created_at    :datetime
#  updated_at    :datetime
#  game_score_id :integer
#

require 'spec_helper'

describe PlayerRealTimeScore do

  context "checking duplicate score validations" do
    let!(:rts0) { create(:player_real_time_score)}

    it "prevents same stat twice for same player and game" do
      expect{create(:player_real_time_score, player: rts0.player,
                    game_score: rts0.game_score)}.to raise_error
    end
    it "allows same stat for same player in different games" do
      expect{create(:player_real_time_score, player: rts0.player)}.to_not raise_error
    end
    it "allows same stat for different player in same game" do
      expect{create(:player_real_time_score,game_score: rts0.game_score)}.to_not raise_error
    end

    it "allows different stats for same player in same game" do
      expect{create(:player_real_time_score,player: rts0.player,
                    game_score: rts0.game_score, name:"stat2")}.to_not raise_error
    end

  end

end
