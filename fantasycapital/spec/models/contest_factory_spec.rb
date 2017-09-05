require 'spec_helper'

describe Contest do

  subject {Contest.all}

  let!(:teams) do [
      create(:team),
      create(:team),
      create(:team)
  ]
  end
  let!(:games) do
    [
        # create games that are far in the future so that contests get created for each date.
        create(:game_score, playdate: "2018-01-16"),
        create(:game_score, playdate: "2018-01-16"),
        create(:game_score, playdate: "2018-01-16"),
        create(:game_score, playdate: "2018-01-17"),
        create(:game_score, playdate: "2018-01-17"),
        create(:game_score, playdate: "2018-01-17"),
        create(:game_score, playdate: "2018-01-18")
    ]
  end


  before do
    ContestFactory.create_contests "NBA"
  end

  describe "when 7 games are scheduled over 3 days" do

    it "there should be 12 contests" do
      should have(12).items   # 6 contests for each game day, 2 game days with >= 3 contests
                              # NOTE: 6 is the reduced amount during beta; post-beta #
                              # (based on uncommenting the contests in contest_factory) is 27.
    end
    it {
      subject.order(contestdate: :asc).first.start_at.should == games[0].scheduledstart
    }

    it "should be idemopotent (identical results when called more than once)" do
      count = subject.count
      ContestFactory.create_contests "NBA"
      subject.count.should == count
    end
  end

  ## NB: I don't understand this test. Ask Kenneth...
  #
  #describe "when 2 games are scheduled for the day" do
  #
  #  let(:games) do
  #    [
  #    create(:projection_scheduled_game, start_date: "2014-01-16 19:30:00-05:00"),
  #    create(:projection_scheduled_game, start_date: "2014-01-16 19:30:00-05:00")
  #    ]
  #  end
  #
  #  it {
  #    should have(0).items
  #  }
  #
  #end
end
