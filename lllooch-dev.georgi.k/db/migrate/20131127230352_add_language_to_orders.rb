class AddLanguageToOrders < ActiveRecord::Migration
  def change
    add_reference :orders, :language, index: true
  end
end
