class CreatePdfs < ActiveRecord::Migration
  def change
    create_table :pdfs do |t|
      t.references :good, index: true

      t.timestamps
    end
  end
end
