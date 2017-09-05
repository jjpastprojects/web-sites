module ApplicationHelper
  def countdown_tag(date, finished_message= 'Contest has begun!', value = nil)
    value ||=  date.today? ? date.strftime("%H:%M:%S") : date.strftime('%a%l:%m%P')

    if date.today?
      content_tag :span, value, class: 'countdown', data:{ date: date.strftime("%B %d, %Y %H:%M:%S"), finished_message: finished_message }
    else
      content_tag :span, value
    end
  end

  def page_title
    content_for?(:title) ? yield(:title) : "Fantasy capital"
  end

  def page_class
    "#{controller_name}_#{action_name}".downcase
  end

  def page_id
    "#{controller_name}_#{action_name}".downcase
  end

  def menu_classes(menu)
    classes = if controller_name.eql? 'contests' and action_name.eql? 'browse'
                { 'home' => 'active'}
              elsif controller_name.eql? 'accounts'
                { 'account' => 'active'}
              elsif controller_name.eql? 'users'
                { 'leaderboard' => 'active' }
              elsif controller_name.eql? 'pages'
                { 'rules' => 'active' }
              else  
                { controller_name => 'active'}
              end
    classes[menu]
  end


end

