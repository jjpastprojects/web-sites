require 'spec_helper'

describe DepositService do
  it 'throws DepositError if outside range' do
    expect { DepositService.new(User.new).deposit(19) }.to raise_error(ServiceError)
    expect { DepositService.new(User.new).deposit(20001) }.to raise_error(ServiceError)
  end
end

