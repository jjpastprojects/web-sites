class AddDesignersGoodsTable < ActiveRecord::Migration
  def change
    create_table :designers_goods do |t|
      t.belongs_to :designer
      t.belongs_to :good
    end
  end
end
