require "spec_helper"

describe WaitingListMailer do
  describe "invite" do
    let(:waiting_list) { create :waiting_list }
    let(:mail) { WaitingListMailer.invite waiting_list }

    it "renders the headers" do
      mail.subject.should eq("Invite")
      mail.to.should eq([waiting_list.email])
      mail.from.should eq(["support@fantasycapital.com"])
    end
  end

end
