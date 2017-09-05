class AddFinalScoreToEntry < ActiveRecord::Migration
  def change
    add_column :entries, :final_score, :decimal
    add_column :entries, :final_pos, :integer
  end
end
