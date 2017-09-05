class AddAttachmentLogoDescToGoods < ActiveRecord::Migration
  def self.up
    change_table :goods do |t|
      t.attachment :logo_desc
    end
  end

  def self.down
    drop_attached_file :goods, :logo_desc
  end
end
