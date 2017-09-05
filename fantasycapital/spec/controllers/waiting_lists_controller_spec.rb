=begin
require 'spec_helper'

describe WaitingListsController do

  let(:valid_attributes) { attributes_for(:waiting_list) }

  let(:valid_session) { {} }

  describe "GET show" do
    it "assigns the requested waiting_list as @waiting_list" do
      waiting_list = WaitingList.create! valid_attributes
      get :show, {:id => waiting_list.to_param}, valid_session
      assigns(:waiting_list).should eq(waiting_list)
    end
  end

  describe "GET new" do
    it "assigns a new waiting_list as @waiting_list" do
      get :new, {}, valid_session
      assigns(:waiting_list).should be_a_new(WaitingList)
    end
  end

  describe "POST create" do
    describe "with valid params" do
      it "creates a new WaitingList" do
        expect {
          post :create, {:waiting_list => valid_attributes}, valid_session
        }.to change(WaitingList, :count).by(1)
      end

      it "assigns a newly created waiting_list as @waiting_list" do
        post :create, {:waiting_list => valid_attributes}, valid_session
        assigns(:waiting_list).should be_a(WaitingList)
        assigns(:waiting_list).should be_persisted
      end

      it "redirects to the created waiting_list" do
        post :create, {:waiting_list => valid_attributes}, valid_session
        response.should redirect_to(WaitingList.last)
      end
    end

    describe "with invalid params" do
      it "assigns a newly created but unsaved waiting_list as @waiting_list" do
        # Trigger the behavior that occurs when invalid params are submitted
        WaitingList.any_instance.stub(:save).and_return(false)
        post :create, {:waiting_list => { "email" => "invalid value" }}, valid_session
        assigns(:waiting_list).should be_a_new(WaitingList)
      end

      it "re-renders the 'new' template" do
        # Trigger the behavior that occurs when invalid params are submitted
        WaitingList.any_instance.stub(:save).and_return(false)
        post :create, {:waiting_list => { "email" => "invalid value" }}, valid_session
        response.should render_template("new")
      end
    end
  end
end
=end
