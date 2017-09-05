require 'spec_helper'

describe EntriesController do

  include_context 'baseentries'

  # every player playing in a game will have an "fp" score previously set during contest creation
  let!(:rtscores) { (0..9).map { |i| create(:player_real_time_score, player:players[i],
                                             game_score:game, name: "fp", value:i*2) } }

  before :each do
    @request.env["devise.mapping"] = Devise.mappings[:user]
    sign_in :user, user

    # stub out Time, returning "now" as defined in our common 'baseentries'
    Time.stub!(:now).and_return(now)
  end

  describe "User2" do
    it "can't view gamecenter with an entry created by User1" do
      sign_out :user
      user2 = create(:user)
      sign_in user2
      get 'show', id: entries[0].id
      expect(response).to redirect_to(root_url)
    end

  end

  describe "GET 'show' (Game Center)" do
    it "correctly assigns players and entries with fantasypoints" do
      get 'show', id: entries[0].id
      # FYI, assigns(:blah) returns value of instance variable @blah in the controller
      expect(response.status).to eq(200)
      retplayers = assigns(:players)
      expect(assigns(:todaysgames)).to eq([game, game2])
      expect(retplayers.count).to be(10)
      expect(retplayers[5]['currfps']).to eq(10)
      expect(retplayers[6]['currfps']).to eq(12)
      expect(assigns(:entries).to_a).to eq([entries[0], entries[1]])
    end
  end

  describe "GET 'index' (Entries' landing page)" do
    it "returns success" do
      get 'index'
      expect(response.status).to eq(200)
    end

    it "displays closed contests properly" do
      # make games closed by adjusting their status
      game.update(status:'closed')
      game2.update(status:'closed')
      RealTimeDataService.new.try_closing_contests todaydate, "NBA"

      get 'index'
      data = assigns(:data)
      expect(data)
      p data
      expect(data[:completedContests].count).to be(2)
      expect(data[:completedContests][0]['final_pos']).to be(1)
      expect(data[:completedContests][1]['final_pos']).to be(1)
    end
  end

    describe "GET 'new'" do
    #it "returns http success" do
     # get 'new', contest_id: contest.id

     # response.should be_success
    #end
  end


#  describe "GET 'edit'" do
#    it "returns http success" do
#      get 'edit'
#      response.should be_success
#    end
#  end
#
#
#  describe "POST 'create'" do
#    describe "with valid params" do
#      it "creates a new Entry" do
#        expect {
#          post :create, {contest_id: @contest.id, entry: {player_ids: [@player.id]}}
#        }.to change(Entry, :count).by(1)
#      end
#    end
#  end
end
