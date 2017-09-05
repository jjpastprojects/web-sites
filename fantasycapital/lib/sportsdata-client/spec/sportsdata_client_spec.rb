require File.expand_path(File.dirname(__FILE__) + '/spec_helper')

describe "SportsdataClient" do
  let(:client) do
    c = SportsdataClient::Client.new ""
    allow(c).to receive(:max_retries).and_return(3)
    allow(c).to receive(:interval).and_return(0)
    c
  end

  describe "When API call returns success" do
    let(:response) do
      r = double()
      allow(r).to receive('success?'.to_sym).and_return(true)
      r
    end

    it "should not retry when getting 2xx" do
      expect(response).to receive(:code).once.and_return(201)
      expect(client.class).to receive(:get).once.and_return(response)
      allow(response).to receive(:parsed_response)
      client.request("", {})
    end
  end

  describe "When API call returns temporary failures" do
    let(:response) do
      r = double()
      allow(r).to receive('success?'.to_sym).and_return(false)
      r
    end

    it "should retry when getting 5xx" do
      expect(response).to receive(:code).exactly(3).times.and_return(501)
      expect(client.class).to receive(:get).exactly(3).times.and_return(response)
      client.request("", {})
    end

    it "should retry when getting timeout" do
      expect(client.class).to receive(:get).exactly(3).times.and_raise(Net::ReadTimeout)
      expect {client.request("", {})}.to raise_error(Net::ReadTimeout)
    end

  end

  describe "When API call returns permanent failures" do
    let(:response) do
      r = double()
      allow(r).to receive('success?'.to_sym).and_return(false)
      r
    end

    it "should not retry when getting 4xx" do
      expect(response).to receive(:code).once.and_return(401)
      expect(client.class).to receive(:get).once.and_return(response)
      client.request("", {})
    end
  end

end
