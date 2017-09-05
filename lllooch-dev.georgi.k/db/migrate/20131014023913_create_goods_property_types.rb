class CreateGoodsPropertyTypes < ActiveRecord::Migration
  def change
    create_table :goods_property_types do |t|
      t.references :good, index: true
      t.references :property_type, index: true
    end
  end
end
