class AddPictureAlignmentToGoods < ActiveRecord::Migration
  def change
    add_column :goods, :picture_alignment, :string
  end
end
