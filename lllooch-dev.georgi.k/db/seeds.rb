languages = YAML::load_file File.join(Rails.root, 'db', 'seeds', 'languages.yml')

languages.each do |l|
  language = Language.find_or_initialize_by name: l['name']
  language.update l
end

page_types = YAML::load_file File.join(Rails.root, 'db', 'seeds', 'page_types.yml')

page_types.each do |t|
  page_type = PageType.find_or_initialize_by method: t['method']
  page_type.update t
end

blog_colors = YAML::load_file File.join(Rails.root, 'db', 'seeds', 'blog_colors.yml')

blog_colors.each do |t|
  blog_color = BlogColor.find_or_initialize_by color: t['color']
  blog_color.update t
end

delivery_types = YAML::load_file File.join(Rails.root, 'db', 'seeds', 'delivery_types.yml')

delivery_types.each do |t|
  dt = DeliveryType.find_or_initialize_by type: t['type']
  dt.update(t)
end

# payment_types = YAML::load_file File.join(Rails.root, 'db', 'seeds', 'payment_types.yml')

# payment_types.each do |type|
#   PaymentType.find_or_create_by type
# end

order_statuses = YAML::load_file File.join(Rails.root, 'db', 'seeds', 'order_statuses.yml')

order_statuses.each do |status|
  order_status = OrderStatus.find_or_initialize_by type: status['type']
  order_status.update(status)
end