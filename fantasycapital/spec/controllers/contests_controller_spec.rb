require 'spec_helper'

describe ContestsController do

  # This should return the minimal set of attributes required to create a valid
  # Contest. As you add validations to Contest, be sure to
  # adjust the attributes here as well.
  let(:valid_attributes) { attributes_for :contest }

  # This should return the minimal set of values that should be in the session
  # in order to pass any filters (e.g. authentication) defined in
  # ContestsController. Be sure to keep this updated too.
  let(:valid_session) { {} }
  let(:user) { create(:user) }

  describe "GET index" do

    before do
      @request.env["devise.mapping"] = Devise.mappings[:user]
      sign_in :user, user
    end

    it "assigns all contests as @contests" do

      contest = create(:contest)
      get :index, {}, valid_session
      assigns(:contests).should eq(user.contests)
    end
  end

  describe "GET browse" do
    it "responds with success" do
      get :browse
      expect(response.status).to be(200)
    end

  end


  end
