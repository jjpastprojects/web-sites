class AddAttachmentPanoramaToGoods < ActiveRecord::Migration
  def self.up
    change_table :goods do |t|
      t.attachment :panorama
    end
  end

  def self.down
    drop_attached_file :goods, :panorama
  end
end
