class RenameLastFourForCards < ActiveRecord::Migration
  def change
    rename_column :credit_cards, :last_four, :last_4
  end
end
