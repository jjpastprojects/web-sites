class AddSuffixToVariants < ActiveRecord::Migration
  def change
    change_table :variants do |t|
      t.string :suffix, null: false, default: ''
    end
  end
end
