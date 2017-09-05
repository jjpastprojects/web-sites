class AddAttachmentSrcToMediaItems < ActiveRecord::Migration
  def self.up
    change_table :media_files do |t|
      t.attachment :src
    end
  end

  def self.down
    drop_attached_file :media_files, :src
  end
end
