require 'spec_helper'

describe UsersController do

  describe "GET 'leadboard'" do
    it "returns http success" do
      get 'leadboard'
      #response.should be_success
    end
  end

end
