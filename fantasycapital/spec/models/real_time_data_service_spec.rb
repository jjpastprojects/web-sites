require 'spec_helper'

describe RealTimeDataService do

  include_context 'baseentries'
  let(:pusher_mock) { double('channel') }

  let(:game_schedule) do
    [{ 'id' => game.ext_game_id,
        'home' => {}, 'away' => {},
        'home_team' => "xxx-id-of-team-1", 'away_team' => "yyy-id-of-team-2",
        'status' => 'inprogress',
        'scheduled' => now - 30.minutes,
        "home"=> {"name"=>"Philadelphia 76ers", "alias"=>"PHI", "id"=>"xxx-id-of-team-1"},
        "away"=> {"name"=>"Indiana Pacers", "alias"=>"IND", "id"=>"yyy-id-of-team-2"},
      }]
  end
  let (:game_details) do
    { 'id' => game.ext_game_id,
      'status' => 'inprogress',
      'quarter' => "2",
      'clock' => "4:25",
      'team' => [{'points' => "54", 'players' => { 'player'=> [
                      { "id" => players[2].ext_player_id,
                        "statistics" => {"assists" => "1.0", "steals" => "2", "rebounds" => "3" }
                      }]}
                 },
                 {'points' => "22",  'players' => { 'player'=> [
                      { "id" => players[0].ext_player_id,
                        "statistics" => {"assists" => "2.0", "steals" => "4", "rebounds" => "6" }
                      }]
                  }}],
    }
  end
  let(:game_expect) { {:games=>[{"id"=>game.id, "pretty_play_state"=>"28 MIN LEFT",
                              "game_remaining"=>28,
                              "home_team_score"=>54, "away_team_score"=>22}]}
  }
  # NBA fantasy point calculation:
  #Point	 1.00     Rebound	 1.25     Assist 1.50   Steal	2.00     Block 2.00  Turnover (1.00)
  # pl2 FPS: 3*1.25+1*1.5+2*2 = 9.25 id1;; pl0 FPS: 6*1.25+2*1.5+4*2 = 18.5
  # entries' fantasypoint scores are all 0 b/c we didn't set up lineups with real players.

  let(:player_expect) {
    {:players=>[{:id=>players[2].id, :rtstats=>"3R 1A 2S", :currfps=>9.25},
                {:id=>players[0].id, :rtstats=>"6R 2A 4S", :currfps=>18.5}]}
  }

  # fantasy point expectation:
  #   55 + 33 (from shared context file) + 9.25 + 18.5 (from game_details message)
  #  = 115.75
  let(:entries_expect) {
    {:entries=>[{"id"=>entries[0].id, "fps"=>115.75}, {"id"=>entries[1].id, "fps"=>115.75}]}
  }

  before do
    Pusher.stub(:[]).with('NBA-gamecenter').and_return(pusher_mock)
  end

  context "closing contests" do
    #
    it "closes entry whose games are done" do
      game.update(status: 'closed')
      game2.update(status:'closed')
      RealTimeDataService.new.try_closing_contests todaydate, "NBA"
      entry0 = Entry.find(entries[0].id)
      entry1 = Entry.find(entries[1].id)
      expect([entry0[:final_score], entry0[:final_pos]]).to eq([88, 1])
      expect([entry1[:final_score], entry1[:final_pos]]).to eq([88, 1])
    end

    it "won't close an entry when a game is still in progress" do
      game.update(status:'closed')  # only one of the two games is closed...
      RealTimeDataService.new.try_closing_contests todaydate, "NBA"
      entry0 = Entry.find(entries[0].id)
      entry1 = Entry.find(entries[1].id)
      expect([entry0[:final_score], entry0[:final_pos]]).to eq([nil, nil])
      expect([entry1[:final_score], entry1[:final_pos]]).to eq([nil, nil])
    end
  end

  context "the first time it's called" do
    # we'll be getting 4 player stats per player, so 8 stats total
    it "delivers 8 scores" do
      RealTimeDataService.new.refresh_schedule(game_schedule, "NBA")
      expect(pusher_mock).to receive(:trigger).with("stats", game_expect)
      expect(pusher_mock).to receive(:trigger).with("stats", player_expect)
      expect(pusher_mock).to receive(:trigger).with("stats", entries_expect)
      RealTimeDataService.new.refresh_game(game_details)
      RealTimeDataService.new.refresh_entries todaydate, "NBA"

      # 10 entries in playerrealtimescore -- 2 players * 4 stats, + 2 fantasypoint values seeded
      #  from the baseentries file.
      expect(PlayerRealTimeScore.all.count).to be(10)
    end
    it "receives correct game update, player update, and entry update" do
      RealTimeDataService.new.refresh_schedule(game_schedule, "NBA")


      expect(pusher_mock).to receive(:trigger).with("stats", game_expect)
      expect(pusher_mock).to receive(:trigger).with("stats", player_expect)
      expect(pusher_mock).to receive(:trigger).with("stats", entries_expect)

      RealTimeDataService.new.refresh_game(game_details)
      RealTimeDataService.new.refresh_entries todaydate, "NBA"
    end
  end

  context "called two times with no change" do
    it "contains stats for 2 players" do
      RealTimeDataService.new.refresh_schedule(game_schedule, "NBA")
      @gameid = GameScore.find_by_ext_game_id("aaa-id-of-game-1").id

      expect(pusher_mock).to receive(:trigger).with("stats", game_expect)
      expect(pusher_mock).to receive(:trigger).with("stats", player_expect)
      expect(pusher_mock).to receive(:trigger).with("stats", entries_expect)

      RealTimeDataService.new.refresh_game(game_details)
      RealTimeDataService.new.refresh_schedule(game_schedule, "NBA")
      RealTimeDataService.new.refresh_game(game_details)
      RealTimeDataService.new.refresh_entries todaydate, "NBA"

    end
  end

  context "called two times with changes in scores" do

    it "will result in game, player, and player update messages with correct stats and fantasy points" do
      # receive push msg 3x (games, players, entries) during initial call to refresh_schedule/game,
      # then 3x for second refresh.
      expect(pusher_mock).to receive(:trigger).once.with("stats", game_expect)
      expect(pusher_mock).to receive(:trigger).once.with("stats", player_expect)
      expect(pusher_mock).to receive(:trigger).once.with("stats", entries_expect)

      RealTimeDataService.new.refresh_schedule(game_schedule, "NBA")
      RealTimeDataService.new.refresh_game(game_details)
      RealTimeDataService.new.refresh_entries todaydate, "NBA"
      # change a player's steals
      game_src1 = game_details.clone
      game_src1['team'][0]['players']['player'][0]['statistics']['steals'] = 82

      # create expected results for player
      player_exp2 = player_expect.clone
      player_exp2[:players][0][:rtstats] = "3R 1A 82S"
      player_exp2[:players][0][:currfps] = 169.25
      player_exp2[:players].delete_at(1) # player 1 didn't change, so no update for him.
      expect(pusher_mock).to receive(:trigger).once.with("stats", player_exp2)

      # entries update when any player updates.
      entries_expect2 = entries_expect.clone
      entries_expect2[:entries][0]["fps"] = 275.75
      entries_expect2[:entries][1]["fps"] = 275.75
      expect(pusher_mock).to receive(:trigger).once.with("stats", entries_expect2)

      RealTimeDataService.new.refresh_schedule(game_schedule, "NBA")
      RealTimeDataService.new.refresh_game(game_src1)
      RealTimeDataService.new.refresh_entries todaydate, "NBA"
    end
  end

  context "when a new game is scheduled" do
    it "creates a new game entry" do
      pending "We should test this"
    end

  end
  context "when there are 80 player changes" do
    let!(:players) {  create_list(:player, 80, sport_position: positions[0]) }

    it "will send one msg with 50, and one with 30" do
      game_src1 = game_details.clone
      @player_extids = Player.all.pluck('ext_player_id')
      expect(@player_extids.count >= 80)
      @player_extids.each_with_index do |extid, idx|
        game_src1['team'][0]['players']['player'] <<
            { "id" => extid,  # this is the ID defined in players' factory
              "statistics" => {"assists" => (15+idx).to_s, "steals" => (15+idx*2).to_s,
                               "rebounds" => (15+idx*3).to_s }
            }
      end
      # with 80 changes, there are 80 messages to send.
      # That means 2 Pusher messages, plus 1 for the games message.
      expect(pusher_mock).to receive(:trigger).once.with("stats", game_expect)
      expect(pusher_mock).to receive(:trigger).once do |event, msg|
        expect(event).to eq("stats")
        expect(msg[:players].count).to be(50)
      end
      expect(pusher_mock).to receive(:trigger).once do |event, msg|
        expect(event).to eq("stats")
        expect(msg[:players].count).to be(30)
      end
      entries_expect[:entries][0]["fps"] = 1076 # high fantasy point score from all the stats.
      entries_expect[:entries][1]["fps"] = 1076
      expect(pusher_mock).to receive(:trigger).once.with("stats", entries_expect)

      RealTimeDataService.new.refresh_schedule(game_schedule, "NBA")
      RealTimeDataService.new.refresh_game(game_src1)
      RealTimeDataService.new.refresh_entries todaydate, "NBA"

    end
  end

  context "when a contest starts" do
    it 'will receive a contest object over realtimedataservice' do
      pending "need to add this"
    end
  end

  context "when a corrupted payload is returned" do
    let (:game_details) do
      { 
        'status' => 'inprogress',
        'period' => "2",
        'clock' => "4:25",
        'team' => [{'points' => "54", 'players' => { 'player'=> [
                      { 
                        "statistics" => {"assists" => "1.0", "steals" => "2", "rebounds" => "3" }
                      }]}
                 },
                 {'points' => "22",  'players' => { 'player'=> [
                      { 
                        "statistics" => {"assists" => "2.0", "steals" => "4", "rebounds" => "6" }
                      }]
                  }}],
      }
    end

    it "should not raise exception" do
     expect { RealTimeDataService.new.refresh_game(game_details) }.not_to raise_error
    end
  end
end
