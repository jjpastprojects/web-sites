class AddAttachmentThumbToGoods < ActiveRecord::Migration
  def self.up
    change_table :goods do |t|
      t.attachment :thumb
    end
  end

  def self.down
    drop_attached_file :goods, :thumb
  end
end
