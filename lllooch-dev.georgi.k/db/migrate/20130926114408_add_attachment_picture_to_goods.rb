class AddAttachmentPictureToGoods < ActiveRecord::Migration
  def self.up
    change_table :goods do |t|
      t.attachment :picture
    end
  end

  def self.down
    drop_attached_file :goods, :picture
  end
end
