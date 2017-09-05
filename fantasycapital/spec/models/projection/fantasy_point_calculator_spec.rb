require 'spec_helper'

describe Projection::FantasyPointCalculator do

  subject { Projection::FantasyPointCalculator.create_for_sport('NBA') }

  let!(:teams) { create_list(:project_team, 2)}
  let!(:players) { (0..9).map { |i| create(:projection_player, team: teams[i%2]) } }
  let!(:sch_game) { create(:projection_scheduled_game, home_team: teams[0], away_team: teams[1])}

  describe "only 1 game exists" do

    context "all NBA stats are in" do
      before(:each) do
        create(:projection_stat, stat_name: "Assists", stat_value: 3)
        create(:projection_stat, stat_name: "Steals", stat_value: 5)
        create(:projection_stat, stat_name: "Blocks", stat_value: 6)
        create(:projection_stat, stat_name: "Turnovers", stat_value: 7)
      end
      it "Updates" do
        # this is currently basically a syntax check. Add some value checking as I understand the code better.
        subject.update sch_game
        puts "HI"
      end
      pending "We should add some value checking to #{__FILE__}"


      #its(:latest_points) { should == 10 + 8*1.25 + 3 * 1.5 + 5 * 2 + 6 * 2 + 7 * -1 }

    end
  end

end
