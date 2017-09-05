class UpdateOrderingStuff < ActiveRecord::Migration
  def up
    drop_table :carts if ActiveRecord::Base.connection.table_exists? 'carts'
    drop_table :cart_goods if ActiveRecord::Base.connection.table_exists? 'cart_goods'
    drop_table :delivery_types if ActiveRecord::Base.connection.table_exists? 'delivery_types'
    drop_table :payment_types if ActiveRecord::Base.connection.table_exists? 'payment_types'
    drop_table :order_statuses if ActiveRecord::Base.connection.table_exists? 'order_statuses'
  end

  def down
    # nothing, we don't need that sheat anymore
  end
end
