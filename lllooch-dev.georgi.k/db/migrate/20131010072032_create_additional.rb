class CreateAdditional < ActiveRecord::Migration
  def change
    create_table :goods_goods do |t|
      t.references :good, index: true
      t.references :parent, index: true
    end
  end
end