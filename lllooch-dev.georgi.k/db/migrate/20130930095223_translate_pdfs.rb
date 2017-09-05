class TranslatePdfs < ActiveRecord::Migration
  def up
    Pdf.create_translation_table!({
      :name => :string
    }, {
      :migrate_data => true
    })
  end

  def down
    Pdf.drop_translation_table! :migrate_data => true
  end
end
