class TranslateOrderStatuses < ActiveRecord::Migration
  def up
    remove_column :order_statuses, :name

    OrderStatus.create_translation_table!({
                                               :name => :string
                                           }, {
                                               :migrate_data => true
                                           })
  end

  def down
    OrderStatus.drop_translation_table! :migrate_data => true
  end
end
