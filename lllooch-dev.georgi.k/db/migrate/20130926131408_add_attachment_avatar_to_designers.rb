class AddAttachmentAvatarToDesigners < ActiveRecord::Migration
  def self.up
    change_table :designers do |t|
      t.attachment :avatar
    end
  end

  def self.down
    drop_attached_file :designers, :avatar
  end
end
