class AddIsUploadedToThree60 < ActiveRecord::Migration
  def change
    add_column :media_files, :is_uploaded, :boolean
  end
end
