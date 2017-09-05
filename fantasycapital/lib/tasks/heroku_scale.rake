require 'heroku-api'

desc "scale heroku dynos"
task heroku_scale: :environment do
  dyno = ENV['dyno']
  num = ENV['num'].to_i || 1
  heroku = Heroku::API.new(:api_key => ENV['HEROKU_API_KEY'])
  heroku.post_ps_scale(Rails.configuration.app_name, dyno, num)
end
