class TranslateGoods < ActiveRecord::Migration
  def up
    remove_column :goods, :price
    remove_column :goods, :title
    remove_column :goods, :heading
    remove_column :goods, :keywords
    remove_column :goods, :description

    Good.create_translation_table!({
      :price => :string,
      :title => :string,
      :heading => :string,
      :keywords => :text,
      :description => :text
    }, {
      :migrate_data => true
    })
  end

  def down
    Good.drop_translation_table! :migrate_data => true
  end
end