class AddDeliveryTypeToDeliveryRequests < ActiveRecord::Migration
  def change
    add_reference :delivery_requests, :delivery_type, index: true, null: false
  end
end
