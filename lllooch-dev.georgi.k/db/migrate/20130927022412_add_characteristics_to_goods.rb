class AddCharacteristicsToGoods < ActiveRecord::Migration
  def self.up
    change_table(:goods) do |t|
      t.decimal :width
      t.decimal :height
      t.decimal :depth
      t.decimal :box_width
      t.decimal :box_height
      t.decimal :box_depth
      t.boolean :is_electrical
    end

    change_table(:good_translations) do |t|
      t.text :announce
      t.text :content
      t.text :additional
    end
  end

  def self.down
    remove_column :goods, :width
    remove_column :goods, :height
    remove_column :goods, :depth
    remove_column :goods, :box_width
    remove_column :goods, :box_height
    remove_column :goods, :box_depth
    remove_column :goods, :is_electrical
    
    remove_column :good_translations, :announce
    remove_column :good_translations, :content
    remove_column :good_translations, :additional
  end
end
