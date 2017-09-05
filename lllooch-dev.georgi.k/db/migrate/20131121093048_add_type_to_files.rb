class AddTypeToFiles < ActiveRecord::Migration
  def change
    rename_table :pdfs, :files
    change_table :files do |t|
      t.string :type, null: false, default: 'GoodFile::Pdf'
    end
  end
end
