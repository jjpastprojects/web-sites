require 'spec_helper'

describe AccountsHelper do

  describe 'only_us_and_canada_regions' do
    it 'has all us and ca regions' do
      only_us_and_canada_regions.length.should == 70
    end
  end
end
