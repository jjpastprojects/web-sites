class AddSiteToOrder < ActiveRecord::Migration
  def change
    add_column :orders, :site, :string
  end
end
