class GoodsTags < ActiveRecord::Migration
  def change
    create_table :goods_tags do |t|
      t.references :good, index: true
      t.references :tag, index: true
    end
  end
end
