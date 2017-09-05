class AddWeightToMediaFiles < ActiveRecord::Migration
  def change
    add_column :media_files, :weight, :integer
  end
end
