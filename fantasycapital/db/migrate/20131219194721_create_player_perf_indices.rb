class CreatePlayerPerfIndices < ActiveRecord::Migration
  def change
    create_table :player_perf_indices do |t|
      t.references :player, index: true
      t.string :index_name
      t.string :index_value

      t.timestamps
    end
  end
end
