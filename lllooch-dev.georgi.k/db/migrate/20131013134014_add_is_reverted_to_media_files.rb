class AddIsRevertedToMediaFiles < ActiveRecord::Migration
  def change
    add_column :media_files, :is_reverted, :boolean
  end
end
