class AddVolumeToGoods < ActiveRecord::Migration
  def change
    add_column :goods, :volume, :integer
  end
end
