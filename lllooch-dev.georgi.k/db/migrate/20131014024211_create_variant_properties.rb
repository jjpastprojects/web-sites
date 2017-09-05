class CreateVariantProperties < ActiveRecord::Migration
  def change
    create_table :variant_properties do |t|
      t.references :variant, index: true
      t.references :property, index: true

      t.timestamps
    end
  end
end
