ActiveAdmin.register User do

  
  # See permitted parameters documentation:
  # https://github.com/gregbell/active_admin/blob/master/docs/2-resource-customization.md#setting-up-strong-parameters
  #
   #permit_params :list, :of, :attributes, :on, :model
   
   permit_params  :password, :password_confirmation, :first_name, :last_name, :country, :state, :username, :email, :ban
   
   index do
    selectable_column
    id_column
    column :username
    column :email
    column :first_name
    column :last_name
    column :balance
    column :country
    column :state
    column :ban
    column :current_sign_in_at
    
    column :created_at    
    actions
  end
   
  filter :username
  filter :email
  filter :country
  filter :state
  filter :balance
  filter :current_sign_in_at
  filter :sign_in_count
  filter :created_at
  filter :ban
  
  form do |f|
    f.inputs "User Details" do
      f.input :username
      f.input :email
      f.input :first_name
      f.input :last_name
      f.input :country      
      f.input :state
      f.input :ban
      f.input :password
      f.input :password_confirmation
      
    end
    f.actions
  end
  
  #
  # or
  #
  # permit_params do
  #  permitted = [:permitted, :attributes]
  #  permitted << :other if resource.something?
  #  permitted
  # end
  
end
