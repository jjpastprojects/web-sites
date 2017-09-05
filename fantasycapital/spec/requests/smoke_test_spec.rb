require 'spec_helper'


# exercise loading each page logged in and not logged in.
describe "Smoke Tests" do
  before {
    expect(Contest.all.count).to be(0)
  }

  let(:contest) { create(:contest)}
  let(:user) { create(:user) }

  URIS = ['/accounts/profile/', '/lineups', '/entries', '/pages/rules_faq']

  context 'when logged in' do
    before(:each) do
      post_via_redirect user_session_path, 'user[username]' => user.username, 'user[password]' => user.password
    end
    URIS.each do |uri|
      it "#{uri} loads" do
        get uri
        response.should be_success
      end
    end

    it "can load lineup page for a contest" do
      get "/lineups/new?contest_id=#{contest.id}"
      response.should be_success
    end
  end


  context 'when not logged in' do
    URIS.each do |uri|
      it "#{uri} redirects to root" do
        get uri
        response.should redirect_to '/'
      end
    end
    it "will redirect if you try to load lineup creation page" do
      get "/lineups/new?contest_id=#{contest.id}"
      response.should redirect_to '/'
    end
  end
end

