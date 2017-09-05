class RemoveMeasurementsAddParametersToGoods < ActiveRecord::Migration
  def change
    remove_columns :goods, :width, :height, :depth, :box_width, :box_height, :box_depth, :is_electrical

    change_table :goods do |t|
      t.text :parameters
    end
  end
end
