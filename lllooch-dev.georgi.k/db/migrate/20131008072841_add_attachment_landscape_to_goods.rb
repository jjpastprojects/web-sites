class AddAttachmentLandscapeToGoods < ActiveRecord::Migration
  def self.up
    change_table :goods do |t|
      t.attachment :landscape
    end
  end

  def self.down
    drop_attached_file :goods, :landscape
  end
end
