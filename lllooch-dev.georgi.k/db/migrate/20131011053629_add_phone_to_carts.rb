class AddPhoneToCarts < ActiveRecord::Migration
  def change
    add_column :carts, :phone, :string
  end
end
