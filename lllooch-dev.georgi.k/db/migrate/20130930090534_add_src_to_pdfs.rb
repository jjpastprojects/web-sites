class AddSrcToPdfs < ActiveRecord::Migration
  def change
    add_column :pdfs, :src, :string
  end
end
