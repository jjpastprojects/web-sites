class AddLocaleToCarts < ActiveRecord::Migration
  def change
    add_reference :carts, :language, index: true
  end
end
