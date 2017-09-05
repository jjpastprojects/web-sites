class AddAttachmentMaterialToVariants < ActiveRecord::Migration
  def self.up
    change_table :variants do |t|
      t.attachment :material
    end
  end

  def self.down
    drop_attached_file :variants, :material
  end
end
