class RenameParentIdToMediaFileId < ActiveRecord::Migration
  def change
    rename_column :media_files, :parent_id, :media_file_id
  end
end
