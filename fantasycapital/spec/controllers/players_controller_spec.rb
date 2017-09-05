require 'spec_helper'

describe PlayersController do

  describe "GET 'stats'" do
    let(:user) { create(:user) }
    let(:sport_pos) { create(:sport_position) }
    let(:player) { create(:player, sport_position: sport_pos) }

    before do
      @request.env["devise.mapping"] = Devise.mappings[:user]
      sign_in :user, user
    end

    it "returns http success" do
      get 'stats', { id: player.id }
      response.should be_success
    end
  end

end
