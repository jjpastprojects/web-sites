class AddWeightToPdfs < ActiveRecord::Migration
  def change
    add_column :pdfs, :weight, :integer
  end
end
