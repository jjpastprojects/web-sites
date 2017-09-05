require 'spec_helper'
describe 'projection:fetch_stats' do  # describe name here is the rake task we execute.

  before do
    Time.stub(:now).and_return(now)
  end

  let(:now) { Time.parse("2014-03-21 12:51:27 -0000")}

  let(:nba_resp) {
    Hash[
       [:team, :player_teams, :all_season_games, :game_stats, :games_scheduled].map { |c|
          [c, JSON.parse(File.read("spec/fixtures/rake_projection/nba_#{c}_resp.json"))]
       }
  ]}

  let(:mlb_resp) {
    Hash[
        [:team, :player_teams, :all_season_games, :game_stats, :games_scheduled].map { |c|
          [c, JSON.parse(File.read("spec/fixtures/rake_projection/mlb_#{c}_resp.json"))]
        }
  ]}

  include_context "rake_shared_context"

  it "fetches NBA stats" do
    PROJECTION_SPORTS.delete(:MLB) # only run NBA projection
    apiclient=SportsdataClient::Sports::NBA

    # stub out the NBA sportsclient's functions and send mock responses
    apiclient.should_receive(:teams).once { nba_resp[:team]}
    apiclient.should_receive(:players).once { nba_resp[:player_teams] }
    apiclient.should_receive(:all_season_games).once { nba_resp[:all_season_games] }

    # 2 games in the all_season_games message, so should see game_stats request two times
    apiclient.should_receive(:game_stats).exactly(2).times { nba_resp[:game_stats] }
    apiclient.should_receive(:games_scheduled).once { nba_resp[:games_scheduled] }

    subject.invoke    # call fetch_stats

    # return constant we messed with back to normal
    PROJECTION_SPORTS=Rails.configuration.sports
  end

  it "fetches MLB stats" do
    PROJECTION_SPORTS.delete(:NBA) # only run MLB projection
    apiclient=SportsdataClient::Sports::MLB

    # stub out the MLB sportsclient's functions and send mock responses
    apiclient.should_receive(:teams).once {
      mlb_resp[:team]
    }
    apiclient.should_receive(:players).once { mlb_resp[:player_teams] }
    apiclient.should_receive(:all_season_games).once { mlb_resp[:all_season_games] }
    apiclient.should_receive(:game_stats).exactly(2).times {
      mlb_resp[:game_stats]
    }
    apiclient.should_receive(:games_scheduled).once { mlb_resp[:games_scheduled] }

    subject.invoke    # call fetch_stats

    # return constant we messed with back to normal
    PROJECTION_SPORTS=Rails.configuration.sports
  end


end
