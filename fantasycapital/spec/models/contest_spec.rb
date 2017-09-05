# == Schema Information
#
# Table name: contests
#
#  id            :integer          not null, primary key
#  title         :string(255)
#  sport         :string(255)
#  contest_type  :string(255)
#  entry_fee     :decimal(, )
#  contest_start :datetime
#  created_at    :datetime
#  updated_at    :datetime
#  max_entries   :integer
#  entries_count :integer          default(0)
#  contestdate   :date
#  rake          :float            default(0.1)
#

require 'spec_helper'
require 'time'
describe Contest do

  before do
    Time.stub(:now).and_return(now)
  end
  let(:now) { Time.parse("2014-03-20 17:51:27 -0700")}
  let(:todaydate) { now.to_date }

  let(:user) { create(:user) }
  let(:lineup) { create(:lineup, user: user) }
  let!(:game) {create(:game_score, playdate:"2014-03-21", scheduledstart: now + 18.hours)}
  let(:contest) { create(:contest, contestdate: game.playdate) }
  describe "Recording contest outcome" do
    let!(:entries) { [
        create(:entry, contest: contest, lineup: lineup),
        create(:entry, contest: contest, lineup: lineup),
        create(:entry, contest: contest, lineup: lineup),
        create(:entry, contest: contest, lineup: lineup),
        create(:entry, contest: contest, lineup: lineup),
        create(:entry, contest: contest, lineup: lineup),
        create(:entry, contest: contest, lineup: lineup),
        create(:entry, contest: contest, lineup: lineup),
        create(:entry, contest: contest, lineup: lineup),
        create(:entry, contest: contest, lineup: lineup)
    ]
    }

    context "calculating winnings on a finished contest" do
      before do
        entries[0].update!(final_score:45)
        entries[1].update!(final_score:50)
        entries[2].update!(final_score:30)
        (3..9).each { |i| entries[i].update(final_score:5) }

      end
      it "calculates H2H winnings" do
        pending("No H2H Logic Yet!")

      end
      it "calculates H2H winnings correctly with a tie" do
        # No rake on an H2H tie!
        pending("No H2H Logic Yet!")

      end
      it "returns empty results for an unfilled contest" do

        pending("We don't check for unfilled contests right now!")

        recorded_entries = contest.record_final_outcome!
        entries[9].destroy
        expect(contest.winnings).to eq([])

      end
      it "returns empty result for an unfinished contest" do
        expect(contest.winnings).to eq([])
      end

      it "calculates tournament winnings" do
        contest.update!(contest_type: 'Tournament')
        recorded_entries = contest.record_final_outcome!

        winnings = contest.winnings
        expect(winnings).to include({entry:entries[1], prize_fraction:1.0})
        expect(winnings.length).to be(1)
      end

      it "calculates tournament winnings correctly with a 3-way tie" do
        contest.update!(contest_type: 'Tournament')
        entries[7].update!(final_score:50)
        entries[8].update!(final_score:50)
        recorded_entries = contest.record_final_outcome!
        winnings = contest.winnings
        expect(winnings.length).to be(3)
        [1,7,8].map do |i|
          expect(winnings).to include({entry:entries[i], prize_fraction:1.0/3.0})
        end
      end

      it "calculates 50/50 winnings" do
        contest.update!(contest_type: '50/50')
        entries[7].update!(final_score:25)
        entries[8].update!(final_score:25)
        recorded_entries = contest.record_final_outcome!
        winnings = contest.winnings
        expect(winnings.length).to be(5)
        [0,1,2,7,8].map do |i|
          expect(winnings).to include({entry:entries[i], prize_fraction:0.2})
        end

      end
      it "calculates 50/50 winnings correctly when everyone ties" do
        # if all 10 entries tie, winnings are 10% to each.
        entries.each { |e| e.update!(final_score:30) }
        recorded_entries = contest.record_final_outcome!
        winnings = contest.winnings
        expect(winnings.length).to be(10)
        (0..9).map do |i|
          expect(winnings).to include({entry:entries[i], prize_fraction:0.1})
        end
      end
      it "calculates 50/50 winnings correctly with a 4-way tie starting from 3rd place" do
        # if there's a 4-way tie in 3rd,4th,5th,6th,7th place, then the distribution is
        # 1st,2nd: 20% each.  3rd/4th/5th/6th: 60%/5 = 12% each.
        entries[6].update!(final_score:30)
        entries[7].update!(final_score:30)
        entries[8].update!(final_score:30)
        recorded_entries = contest.record_final_outcome!
        winnings = contest.winnings
        expect(winnings.length).to be(6)
        [0,1].map do |i|
          expect(winnings).to include({entry:entries[i], prize_fraction:0.2})
        end
        [2,6,7,8].map do |i|
          expect(winnings).to include({entry:entries[i], prize_fraction:0.15})
        end
      end

      it "calculates 50/50 winnings correctly with a 3-way tie in 5th place" do
        entries[7].update!(final_score:25)
        entries[8].update!(final_score:20)
        entries[9].update!(final_score:20)
        entries[6].update!(final_score:20)
        recorded_entries = contest.record_final_outcome!
        winnings = contest.winnings
        expect(winnings.length).to be(7)
        [0,1,2,7].map do |i|
          expect(winnings).to include({entry:entries[i], prize_fraction:0.2})
        end
        [6,8,9].map do |i|
          expect(winnings).to include({entry:entries[i], prize_fraction:(0.2/3.0).round(4)})
        end

      end
      it "calculates 50/50 winnings correctly with a 4-way tie in 4th place" do
        entries[7].update!(final_score:20)
        entries[8].update!(final_score:20)
        entries[9].update!(final_score:20)
        entries[6].update!(final_score:20)
        recorded_entries = contest.record_final_outcome!
        winnings = contest.winnings
        expect(winnings.length).to be(7)
        [0,1,2].map do |i|
          expect(winnings).to include({entry:entries[i], prize_fraction:0.2})
        end
        [6,7,8,9].map do |i|
          expect(winnings).to include({entry:entries[i], prize_fraction:0.1})
        end

      end


    end

    it "returns nil if one or more entries aren't complete" do
      expect(contest.record_final_outcome!).to be(nil)
    end
    it "records entry's final positions properly" do
      entries[0].update!(final_score:45)
      entries[1].update!(final_score:50)
      entries[2].update!(final_score:30)
      (3..9).each { |i| entries[i].update(final_score:5) }
      recorded_entries = contest.record_final_outcome!
      expect(recorded_entries.length).to be(10)
      expect(recorded_entries[0].final_score).to eq(50)
      expect(recorded_entries[1].final_score).to eq(45)
      expect(recorded_entries[2].final_score).to eq(30)
      expect(recorded_entries[0].final_pos).to be(1)
      expect(recorded_entries[1].final_pos).to be(2)
      expect(recorded_entries[2].final_pos).to be(3)

      # make sure entry's position actually got written to DB, not just returned.
      lastentry = Entry.find(entries[1].id)
      expect(lastentry.final_pos).to be(1)

    end

    it "gives same position to two tied scores" do
      entries[0].update!(final_score:45)
      entries[1].update!(final_score:50)
      entries[2].update!(final_score:50)
      (3..9).each { |i| entries[i].update(final_score:5) }

      recorded_entries = contest.record_final_outcome!
      expect(recorded_entries[0].final_pos).to be(1)
      expect(recorded_entries[1].final_pos).to be(1)
      expect(recorded_entries[2].final_pos).to be(3)
    end
  end


  describe "User has entered one contest" do
    subject {
      Contest.in_range(user, now.to_date, now.to_date+1).eligible(user, now)
    }

    # created one entry, thus
    before { create(:entry, contest: contest, lineup: lineup) }

    context "Another contest exists" do
      before {
        @unfilled_contest = create(:contest, contestdate: game.playdate)
      }

      it "User should be eligible to enter the unfilled one" do
        should == [@unfilled_contest]
      end
    end

    context "No other contest exists" do
      it "User is eligible for nothing" do
        should be_empty
      end
    end

    context "contest expired" do
      before do
        c = create(:contest, contestdate: game.playdate)
        create(:entry, contest: c, lineup: lineup)
      end

      it { should be_empty }
    end

    context "Tournament contests" do
      before { @tournament = create(:contest, contest_type: "Tournament", contestdate: game.playdate) }

      it "User should be eligible to enter it" do
        should == [@tournament]
      end

      context "Entered 5 times" do
        before do
          5.times { create(:entry, contest: @tournament, lineup: lineup) }
        end
        it "is ineligible for entry a 6th time" do
          should be_empty
        end
      end
    end

  end

  describe "Contest that only allows one entry, and has one entry" do
    let(:another_contest) { create(:contest, max_entries: 1, contestdate: game.playdate) }
    let(:lineup) { create(:lineup, user: create(:user)) }
    let!(:entry) { create(:entry, contest: another_contest, lineup: lineup) }

    subject {
      Contest.in_range(user, todaydate, todaydate+1).eligible(user, now)
    }

    it "won't be available for entry" do
      should == []
    end
    
    it "will fail when entered again" do
      expect {create(:entry, contest: another_contest, lineup: lineup)}.to raise_error
    end

    it "allows editing an existing entry" do
      # this previously caused a validation error, caught by the too-many-entries validation logic.
      # expect save will be successful now.
      expect(entry.update(final_score:99)).to be(true)
    end


  end

  describe "Entering with lineup" do
    before { create(:entry, contest: contest, lineup: lineup) }

    it "should fail when entering same 50/50 contest twice" do
      expect { contest.enter(lineup) }.to raise_error
    end

    context "Another user is entering" do
      let(:another_user) { create(:user) }
      let(:another_lineup) { create(:lineup, user:another_user) }
    
      it "should enter successfully" do
        contest.enter(another_lineup).should be_present
      end

      context "Contest is already filled" do
        before do
          contest.max_entries = 1
          contest.save!
        end

        it "should fail when another user tries to enter" do
          expect { contest.enter(another_lineup) }.to raise_error
        end
      end

      context "Contest is about to be filled" do
        before do
          contest.max_entries = 2 
          contest.save!
        end

        it "should succeed and clone a new contest" do
          contest.enter(another_lineup).should be_present
          upcoming_cont = Contest.in_range(user, todaydate, todaydate+1).eligible(user, now)
          upcoming_cont.count.should == 1
          expect(contest.filled?).to be(true)
          expect(upcoming_cont[0].contestdate).to eq(contest.contestdate)
          expect(upcoming_cont[0].id).to_not eq(contest.id)

          upcoming_cont[0].max_entries.should == contest.max_entries
        end
      end

    end
  end

end
