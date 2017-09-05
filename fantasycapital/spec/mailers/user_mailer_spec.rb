require "spec_helper"

describe UserMailer do
  describe "password_reset" do
    #let(:user) { FactoryGirl(:user, :password_reset_token => "anything") }
    let(:user) { create :user , :reset_password_token => "randomstring"}
    let(:mail) { UserMailer.password_reset user }

    it "send user password reset url" do
      mail.subject.should eq("Password Reset")
      mail.to.should eq([user.email])
      mail.from.should eq(["support@fantasycapital.com"])
      mail.body.encoded.should match(edit_password_reset_path(user.reset_password_token))
    end
  end
end




