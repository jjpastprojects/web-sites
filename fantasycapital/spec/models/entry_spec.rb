# == Schema Information
#
# Table name: entries
#
#  id          :integer          not null, primary key
#  lineup_id   :integer
#  created_at  :datetime
#  updated_at  :datetime
#  contest_id  :integer
#  final_score :decimal(, )
#  final_pos   :integer
#

require 'spec_helper'

describe Entry do
  include_context 'baseentries'

  it { should belong_to(:lineup) }

  it "reports players according to their positional order when JSONified" do
    # this is what's sent to browser during gametime. need to ensure sort order.
    entry = entries[0]
    entry_parsed = JSON.parse(entry.to_json)

    # make sure players are reported in order of their 'spot' index, so that spots go from 0-9.
    entry_parsed['player_ids'].each_with_index { |(playerid, sport_pos_id), idx|
      expect(lineupspots[9-idx].player.id).to be(playerid)
      expect(lineupspots[9-idx].sport_position.id).to be(sport_pos_id)
      puts "#{playerid}  #{sport_pos_id}"
    }
  end

  it "records final score" do

  end
  it "reports fantasy point scores properly" do
    entry = entries[0]
    entry_parsed = JSON.parse(entry.to_json)
    expect(entry_parsed['fps']).to eq("88.0")
  end

  it "reports what games it belongs to" do
    entry = entries[0]
    entry_games = entry.games
    expect(entry_games.count).to be(2)
    expect(entry_games.first).to eq(game)
  end

  it "reports one game when there's only one" do
    entry_games = entry_day2.games
    expect(entry_games.count).to be(1)
  end

end
