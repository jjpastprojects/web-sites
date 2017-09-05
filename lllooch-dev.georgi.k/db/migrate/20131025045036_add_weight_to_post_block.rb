class AddWeightToPostBlock < ActiveRecord::Migration
  def change
    add_column :post_blocks, :weight, :integer, null: false, default: 0
  end
end
