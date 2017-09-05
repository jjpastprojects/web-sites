class AddRouteToPages < ActiveRecord::Migration
  def change
    add_column :pages, :route, :string
  end
end
