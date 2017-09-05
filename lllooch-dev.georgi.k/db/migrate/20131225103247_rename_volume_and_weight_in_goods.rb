class RenameVolumeAndWeightInGoods < ActiveRecord::Migration
  def change
    add_column :goods, :good_weight, :integer, null: true
    remove_column :goods, :volume
    add_column :goods, :good_volume, :integer, null: true
  end
end
