class AddSourceAndUrlToTranslations < ActiveRecord::Migration
  def change
    add_column :translations, :source, :string
    add_column :translations, :url, :string
  end
end
