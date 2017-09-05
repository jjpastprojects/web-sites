class AddAttachmentPanoramaIpadToGoods < ActiveRecord::Migration
  def self.up
    change_table :goods do |t|
      t.attachment :panorama_ipad
    end
  end

  def self.down
    drop_attached_file :goods, :panorama_ipad
  end
end
