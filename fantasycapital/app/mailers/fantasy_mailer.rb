class FantasyMailer < ActionMailer::Base
  layout 'mailer'
  default from: "\"Fantasy Capital\" <support@fantasycapital.com>"
end
