class AddAttachmentPictureToPostBlocks < ActiveRecord::Migration
  def self.up
    change_table :post_blocks do |t|
      t.attachment :picture
    end
  end

  def self.down
    drop_attached_file :post_blocks, :picture
  end
end
