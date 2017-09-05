ActionMailer::Base.delivery_method = :smtp
ActionMailer::Base.perform_deliveries = true

ActionMailer::Base.smtp_settings = {
  :address              => "smtp.gmail.com",
  :port                 => "587",
  :domain               => 'gmail.com',
  :user_name            => 'order@lllooch.ru',
  :password             => '100pfrfpjd',
  :authentication       => 'plain',
  :enable_starttls_auto => true  
}