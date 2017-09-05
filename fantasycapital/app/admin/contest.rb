ActiveAdmin.register Contest do

  
  # See permitted parameters documentation:
  # https://github.com/gregbell/active_admin/blob/master/docs/2-resource-customization.md#setting-up-strong-parameters
  #
  # permit_params :list, :of, :attributes, :on, :model
  #
  # or
  #
  # permit_params do
  #  permitted = [:permitted, :attributes]
  #  permitted << :other if resource.something?
  #  permitted
  # end
  
  index do
    
    column("ID", :id, :sortable => :id)
    column("Title", :title, :sortable => :title)
    column("Sport", :sport, :sortable => :sport)
    column("Contest Date", :contestdate, :sortable => :contestdate)
    column("Contest Type", :contest_type )
    column("Entry Fee", :entry_fee)
    column("Prize", :prize)
    
    column("Number of Entries", :entries_count)
    column("Winners") {|contest| contest.winnings}
    default_actions
    # column("State") {|order| status_tag(order.state) }
    # column("Date", :checked_out_at)
    # column("Customer", :user, :sortable => :user_id)
    # column("Total") {|order| number_to_currency order.total_price }
    
    # column("ID")  {|contest| contest.id }
    
    
  end
  
  filter :contest_type
  filter :sport
  filter :entry_fee
  filter :contestdate
  filter :max_entries
  
end
