class AddAnnounceToPostTranslations < ActiveRecord::Migration
  def change
    add_column :post_translations, :announce, :text
  end
end
