class AddPageTypeToPages < ActiveRecord::Migration
  def change
    add_reference :pages, :page_type, index: true
  end
end
