class RenamePdfTranslations < ActiveRecord::Migration
  def change
    rename_table :pdf_translations, :file_translations
  end
end
