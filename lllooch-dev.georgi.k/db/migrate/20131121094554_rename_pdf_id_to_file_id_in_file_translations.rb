class RenamePdfIdToFileIdInFileTranslations < ActiveRecord::Migration
  def change
    rename_column :file_translations, :pdf_id, :file_id
  end
end
