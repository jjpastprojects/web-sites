class AddAttachmentPictureToVariants < ActiveRecord::Migration
  def self.up
    change_table :variants do |t|
      t.attachment :picture
    end
  end

  def self.down
    drop_attached_file :variants, :picture
  end
end
