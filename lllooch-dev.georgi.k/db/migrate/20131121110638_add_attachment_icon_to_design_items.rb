class AddAttachmentIconToDesignItems < ActiveRecord::Migration
  def self.up
    change_table :design_items do |t|
      t.attachment :icon
    end
  end

  def self.down
    drop_attached_file :design_items, :icon
  end
end
