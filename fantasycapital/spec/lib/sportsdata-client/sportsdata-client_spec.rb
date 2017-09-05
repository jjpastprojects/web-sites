require 'spec_helper'

describe 'Sportsdata Client' do
  # test sportsdata client, both NBA and MLB variations. This is called purely by rake tasks
  # right now, in realtime and overnight.

  NBA_TEAMS_RESPONSE = File.read("spec/fixtures/sportsdata_client/nba_teams.json")
  MLB_TEAMS_RESPONSE = File.read("spec/fixtures/sportsdata_client/mlb_teams.json")
  describe "response parser" do
    # MLB responses are really weird. A single event is returned as a single JSON item; multiple
    # events are returned as an array. So create a test case for single and multiple responses from
    # the MLB API.
    it "parses multiple events properly" do
      from_api_json=
        '{"calendars":{"event":[{"scheduled_start":"2014-04-25T23:05:00Z","tbd":"false"},
                               {"scheduled_start":"2014-04-26T00:10:00Z",
                                "home":"dcfd5266-00ce-442c-bc09-264cd20cf455","tbd":"false"}],
                      "season_id":"8f4e3a30-8444-11e3-808c-22000a904a71","season_year":"2014"}}'
      from_api = JSON.parse(from_api_json)
      events=SportsdataClient::ResponseParser.new(from_api).parse 'event'
      expect(events.length).to be(2)
      expect(events[0]['scheduled_start']).to eq('2014-04-25T23:05:00Z')
    end
    it "parses a single event properly" do
      from_api_json=
          '{"calendars":{"event":{"scheduled_start":"2014-03-24T17:05:00Z","tbd":"false"},
                         "season_id":"8f4e3a30-8444-11e3-808c-22000a904a71","season_year":"2014"}}'
      from_api = JSON.parse(from_api_json)

      events=SportsdataClient::ResponseParser.new(from_api).parse 'event'
      expect(events.length).to be(1)
      expect(events[0]['scheduled_start']).to eq('2014-03-24T17:05:00Z')
    end
  end
  describe "teams" do
    it "parses NBA teams properly" do
      # stub out the actual call to the sportsdata API
      SportsdataClient::Client.any_instance.stub(:request) do |url, &block|
        block.call(JSON.parse(NBA_TEAMS_RESPONSE))
      end

      teams = SportsdataClient::Sports::NBA.teams
      expect(teams.length).to be(13)
      teamnames=teams.map {|team| team['name']}
      expect(teamnames.sort).to eq(["Bobcats", "Bucks", "Bulls", "Celtics", "Grizzlies", "Kings",
                                    "Magic", "Mavericks", "Nuggets", "Raptors", "Timberwolves",
                                    "Warriors", "Wizards"])
    end

    it "parses MLB teams properly" do

      # stub out the actual call to the sportsdata API
      SportsdataClient::Client.any_instance.stub(:request) do |url, &block|
        block.call(JSON.parse(MLB_TEAMS_RESPONSE))
      end
      teams = SportsdataClient::Sports::MLB.teams
      expect(teams.length).to be(25)
      teamalias=teams.map {|team| team['alias']}
      expect(teamalias.sort).to eq(["AL", "ARI", "ATL", "BAL", "BOS", "CIN", "CLE", "COL", "CWS",
                                    "DET", "HOU", "KC", "LAA", "MIN", "MINOR", "NL", "NOTEAM",
                                    "PHI", "RETIRED", "SD", "SEA", "STL", "TEX", "TOR", "WSH"])
    end
  end

  describe "players" do
    it "parses NBA players properly" do
      # stub out the actual call to the sportsdata API
      players_resp = {}
      nba_teams = ['583ec8d4-fb46-11e1-82cb-f4ce4684ea4c', '583ec97e-fb46-11e1-82cb-f4ce4684ea4c',
                   '583ed157-fb46-11e1-82cb-f4ce4684ea4c']
      nba_teams.each do |team_id|
        players_resp[team_id] = File.read(
                "spec/fixtures/sportsdata_client/nba_player_teams_#{team_id}.json")
      end

      SportsdataClient::Client.any_instance.stub(:request) do |url, &block|
        # called multiple times, once per team in the 'teamhash'. Respond appropriately based on URL
        teamid=url.split('/')[1]
        block.call(JSON.parse(players_resp[teamid]))
      end

      # get a hash of 3 teams by picking a conference and division
      teamsarray = JSON.parse(NBA_TEAMS_RESPONSE)['league']['conference'][0]['division'][0]['team']
      ext_team_ids = teamsarray.map {|team|team['id'] }
      player_teams = SportsdataClient::Sports::NBA.players(ext_team_ids)
      expect(player_teams.length).to be(3)  # 3 teams
      expect(player_teams['583ec8d4-fb46-11e1-82cb-f4ce4684ea4c'].length).to be(8)   # players in team 0
      expect(player_teams['583ec97e-fb46-11e1-82cb-f4ce4684ea4c'].length).to be(9)   # players in team 1
      expect(player_teams['583ed157-fb46-11e1-82cb-f4ce4684ea4c'].length).to be(7)   # players in team 2
      lastnames=player_teams.values.flatten.map {|player| player['last_name']}

      expect(lastnames.sort).to eq(["Afflalo", "Ariza", "Beal", "Biyombo", "Booker", "Gooden",
                                    "Harkless", "Harris", "Haywood", "Hilario", "Jefferson",
                                    "Kidd-Gilchrist", "McRoberts", "Miller", "Nelson", "OQuinn",
                                    "Oladipo", "Price", "Taylor", "Temple", "Tolliver", "Walker",
                                    "Wall", "White"])
    end

    it "parses MLB players properly" do
      players_resp = File.read("spec/fixtures/sportsdata_client/mlb_player_teams.json")
      players_resp = JSON.parse(players_resp)
      SportsdataClient::Client.any_instance.stub(:request) do |url, &block|
        # called multiple times, once per team in the 'teamhash'. Respond appropriately based on URL
        block.call(players_resp)
      end

      # in MLB case, we don't care about the teams hash, so pass nil
      player_teams = SportsdataClient::Sports::MLB.players(nil)
      expect(player_teams.length).to be(9)  # 9 teams
      lastnames = player_teams.values.flatten.map {|player| player['last_name']}
      expect(lastnames).to eq(["Bonifacio", "Ramirez", "Wright", "Revere", "Papelbon", "Young",
                               "Young", "Kubel", "Burton", "Arencibia", "Chirinos", "Andrus",
                               "Beltre", "Robertson", "Cotts", "Darvish", "McCann", "Jeter",
                               "Johnson", "Roberts", "Kuroda", "Leroux", "Nuno", "Leon", "Lobaton",
                               "Werth", "Barrett", "Blevins"])


    end
  end

  describe "all_season games" do
    # test SportsdataClient::Sports::NBA.all_season_games
    it "parses NBA properly" do
      pending
    end

    it "parses MLB properly" do
      pending
    end
  end

  describe "game_stats" do
    let (:mlb_game_stats_resp) { File.read("spec/fixtures/sportsdata_client/mlb_game_stats.json") }
    let (:nba_game_stats_resp) { File.read("spec/fixtures/sportsdata_client/nba_game_stats.json") }

    # test SportsdataClient::Sports::NBA.game_stats

    it "parses NBA properly" do
      SportsdataClient::Client.any_instance.stub(:request) do |url, &block|
        block.call(JSON.parse(nba_game_stats_resp))
      end
      game_stats=SportsdataClient::Sports::NBA.game_stats('whatever-nba-ext-id')
      expect(game_stats.length).to be(2)  # expect 2 teams
      expect(game_stats[0]['players']['player'].length).to be(15)  # first team player count
      expect(game_stats[1]['players']['player'].length).to be(15)  # 2nd team player count

      puts "HI"
    end

    it "parses MLB properly" do
      SportsdataClient::Client.any_instance.stub(:request) do |url, &block|
        JSON.parse(mlb_game_stats_resp) # BUGBUG: non-block usage of this in mlb.rb... we should change it to a block
      end

      game_stats=SportsdataClient::Sports::MLB.game_stats('whatever-mlext-id')
      expect(game_stats.length).to be(2)  # expect 2 teams
      expect(game_stats[0]['players']['player'].length).to be(17)  # first team has 17 players
      expect(game_stats[1]['players']['player'].length).to be(13)  # 2nd team has 13 players

    end
  end

  describe "games_scheduled" do
    # test SportsdataClient::Sports::NBA.games_scheduled
    it "parses NBA properly" do
      pending
    end

    it "parses MLB properly" do
      pending
    end
  end

  describe "full_game_stats" do
    # test SportsdataClient::Sports::NBA.full_game_stats
    it "parses NBA properly" do
      pending
    end

    it "parses MLB properly" do
      pending
    end
  end

end
