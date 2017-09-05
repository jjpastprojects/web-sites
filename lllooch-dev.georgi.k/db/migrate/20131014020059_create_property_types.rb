class CreatePropertyTypes < ActiveRecord::Migration
  def change
    create_table :property_types do |t|

      t.timestamps
    end
  end
end
