require 'spec_helper'

describe LineupsController do
  let!(:game) {create(:game_score) }
  let!(:contest) { create(:contest, max_entries: 2)}
  let(:user) { create(:user) }
  let(:sport_pos) { create(:sport_position) }
  before do
    Time.stub(:now).and_return(now)
  end

  let(:now) { Time.parse("2014-03-12 12:51:27 -0000")}

  before :each do
    @player = create(:player, sport_position: sport_pos)
    @request.env["devise.mapping"] = Devise.mappings[:user]
    sign_in :user, user
  end

  describe "when contest has no entries" do
    it "should succeed when user enters the contest" do
      expect {
        post :create, {lineup: {contest_id_to_enter: contest.id, sport: "NBA"}}
      }.to change(Entry, :count).by(1)
    end
  end

  describe "when contest is filled" do
    before :each do
      contest.entries.create(lineup: create(:lineup))
      contest.entries.create(lineup: create(:lineup))
    end

    it "should redirect to / when user tries to enter" do
      post :create, {lineup: {contest_id_to_enter: contest.id, sport: "NBA"}}
      response.should redirect_to "/"
    end
  end

  describe "when contest has started" do
    before do
      Time.stub(:now).and_return(now+24.hours)
    end

    it "can't enter the contest" do
      entry = contest.entries.create(lineup: create(:lineup))
      expect(entry.error_on(:contest)[0]).to eq("Can't enter a contest that started!")
    end
  end

end
