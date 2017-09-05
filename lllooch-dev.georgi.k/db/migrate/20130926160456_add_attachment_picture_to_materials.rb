class AddAttachmentPictureToMaterials < ActiveRecord::Migration
  def self.up
    change_table :materials do |t|
      t.attachment :picture
    end
  end

  def self.down
    drop_attached_file :materials, :picture
  end
end
