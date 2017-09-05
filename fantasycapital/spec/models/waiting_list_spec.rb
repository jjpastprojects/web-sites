# == Schema Information
#
# Table name: waiting_lists
#
#  id               :integer          not null, primary key
#  email            :string(255)
#  name             :string(255)
#  created_at       :datetime
#  updated_at       :datetime
#  invited_by_token :string(255)
#  invitation_token :string(255)
#  status           :integer          default(1)
#  user_id          :integer
#  message          :string(255)
#

=begin
require 'spec_helper'

describe WaitingList do
  it { should belong_to(:user) }

  it { should validate_presence_of(:email) }
  it { should validate_uniqueness_of(:email) }

  describe "instance method" do
    let(:waiting_list) { create :waiting_list }
    subject { waiting_list }

    specify { subject.invitation_token.should be_present }
    specify { subject.to_param.should eql subject.invitation_token }

    specify do
      #Mock deliver method of ActionMailer
      allow(nil).to receive(:deliver) { true }
      WaitingListMailer.should_receive(:invite).with(waiting_list)

      waiting_list.invite!
    end

    describe "after invitation sent" do
      before {subject.invite!}

      specify { subject.should be_invited }
    end
  end
end
=end
