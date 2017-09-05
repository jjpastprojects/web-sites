class AddMottoToDesigners < ActiveRecord::Migration
  def self.up
    change_table(:designer_translations) do |t|
      t.string :motto
    end
  end

  def self.down
    remove_column :designer_translations, :motto
  end
end
