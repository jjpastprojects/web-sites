require "spec_helper"

describe ContestsController do
  describe "routing" do
    it "routes to root" do
      get("/").should route_to("contests#browse")
    end

    it "routes to #index" do
      get("/contests").should route_to("contests#index")
    end

    it "routes to #browse" do
      get("/contests/browse").should route_to("contests#browse")
    end

    it "routes to #show" do
      get("/contests/1").should route_to("contests#show", :id => "1")
    end

  end
end
