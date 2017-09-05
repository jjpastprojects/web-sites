class CreateDesignerGoods < ActiveRecord::Migration
  def change
    create_table :designer_goods do |t|
      t.references :designer, index: true
      t.references :good, index: true

      t.timestamps
    end
  end
end
