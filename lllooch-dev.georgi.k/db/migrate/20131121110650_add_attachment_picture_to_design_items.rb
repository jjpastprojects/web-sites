class AddAttachmentPictureToDesignItems < ActiveRecord::Migration
  def self.up
    change_table :design_items do |t|
      t.attachment :picture
    end
  end

  def self.down
    drop_attached_file :design_items, :picture
  end
end
