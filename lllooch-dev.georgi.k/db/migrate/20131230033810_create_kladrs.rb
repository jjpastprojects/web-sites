class CreateKladrs < ActiveRecord::Migration
  def change
    create_table :kladrs do |t|
      t.string :city, null: false
      t.string :code, null: false
    end
  end
end
