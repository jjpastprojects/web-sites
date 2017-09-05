
shared_context 'baseentries' do
  before do
    Time.stub(:now).and_return(now)
  end

  let(:now) { Time.parse("2014-03-21 12:51:27 -0000")}

  let(:todaydate) { now.to_date }

  let!(:positions) { create_list(:sport_position, 6)}
  let(:user) { create(:user) }
  let!(:lineup) { create(:lineup, user:user)}
  let!(:teams) { create_list(:team, 4)}
  let!(:players) { (0..9).map { |i| create(:player, sport_position: positions[i % 6], team: teams[i%4]) } }
  let!(:lineupspots) { (0..9).map { |i| create(:lineup_spot, player: players[9-i], spot:9-i,
                                               sport_position:players[9-i].sport_position,
                                               lineup:lineup) } }

  # one day's entry and contest, with 2 games. No player from this entry is in game2
  let!(:contest) { create(:contest, contestdate:todaydate)}
  let!(:game) {create(:game_score, playdate:todaydate, home_team: teams[0], away_team: teams[1], ext_game_id: "aaa-id-of-game-1")}
  let!(:game2) {create(:game_score, playdate:todaydate, home_team: teams[2], away_team: teams[3])}
  let!(:entries) { [create(:entry, contest:contest, lineup:lineup),
                    create(:entry, contest:contest, lineup:lineup)]}

  # another day's entry and contest (with no game)
  let!(:contest_day2) { create(:contest, contestdate:todaydate+1)}
  let!(:game_day2) {create(:game_score, playdate:todaydate+1, home_team: teams[1], away_team: teams[3])}
  let!(:entry_day2) { create(:entry, contest:contest_day2, lineup:lineup) }
  let!(:rtscores) { [create(:player_real_time_score, player:players[5], game_score:game, name: "fp", value:55),
                     create(:player_real_time_score, player:players[6], game_score:game, name: "fp", value:33)]}

end
