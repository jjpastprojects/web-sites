class AddAttachmentPortraitToGoods < ActiveRecord::Migration
  def self.up
    change_table :goods do |t|
      t.attachment :portrait
    end
  end

  def self.down
    drop_attached_file :goods, :portrait
  end
end
