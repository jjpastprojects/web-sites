class AddSizeToPdfs < ActiveRecord::Migration
  def change
    add_column :pdfs, :size, :integer
  end
end
