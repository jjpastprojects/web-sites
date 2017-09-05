class CreateProperties < ActiveRecord::Migration
  def change
    create_table :properties do |t|
      t.references :property_type, index: true

      t.timestamps
    end
  end
end
