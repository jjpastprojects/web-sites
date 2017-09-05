class AddIsActiveToLanguages < ActiveRecord::Migration
  def change
    add_column :languages, :is_active, :boolean
  end
end
