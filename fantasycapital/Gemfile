source 'https://rubygems.org'

ruby "2.0.0"

# Bundle edge Rails instead: gem 'rails', github: 'rails/rails'
gem 'rails', '4.0.2'

gem 'pg'

gem 'gibbon'

gem 'carmen-rails', '~> 1.0.0', github: 'jim/carmen-rails'

gem 'stripe'

gem 'activerecord-session_store', '0.1.0'

# Use jasmine for unit tests
gem 'jasmine'

# Use SCSS for stylesheets
gem 'sass-rails', '~> 4.0.0'

# Use Compass for stylesheets
gem 'compass-rails'

# Use Uglifier as compressor for JavaScript assets
gem 'uglifier', '>= 1.3.0'

# Use CoffeeScript for .js.coffee assets and views
gem 'coffee-rails', '~> 4.0.0'

# See https://github.com/sstephenson/execjs#readme for more supported runtimes
# gem 'therubyracer', platforms: :ruby

# Use jquery as the JavaScript library
gem 'jquery-rails'
gem 'angularjs-rails', '~> 1.2'

# Turbolinks makes following links in your web application faster. Read more: https://github.com/rails/turbolinks
gem 'turbolinks'
gem 'social-share-button'
gem 'premailer-rails'
gem 'delayed_job'

gem "stats_client", path: "lib/"
gem "sportsdata-client", path: "lib/"

gem 'newrelic_rpm'
gem 'newrelic-rake'

gem 'pusher'
gem 'resque', require: "resque/server"
gem 'resque-web', require: 'resque_web'
gem 'sidekiq'
gem 'sinatra', '>= 1.3.0', :require => nil

# Build JSON APIs with ease. Read more: https://github.com/rails/jbuilder
#gem 'jbuilder', '~> 1.2'

group :doc do
  # bundle exec rake doc:rails generates the API under doc/api.
  gem 'sdoc', require: false
end

gem 'pony'
gem 'hpricot'

# Use ActiveModel has_secure_password
# gem 'bcrypt-ruby', '~> 3.1.2'

# Use unicorn as the app server
# gem 'unicorn'

# Use Capistrano for deployment
# gem 'capistrano', group: :development

# Use debugger
gem 'devise'
gem "bullet"

gem 'heroku'

# send gzip encoding on static assets from precompiled asset files
gem 'rack-zippy'

# unicorn web server for production
gem 'unicorn'

# active admin
gem 'activeadmin', github: 'gregbell/active_admin'

group :development do
  gem 'mailcatcher'
end

group :production, :staging do
  gem 'rails_12factor'
  gem "rack-google-analytics"
  gem 'airbrake'
end

group :development, :test do
  gem 'pry-rails'
  gem 'pry-byebug'
  gem 'better_errors'
  gem 'binding_of_caller'
  gem 'annotate'
  gem "factory_girl_rails", "~> 4.0"
  gem "rspec-rails"
  gem 'meta_request'
  gem 'byebug' unless ENV["RM_INFO"]  # don't use debugger if IDE is RubyMine
  gem 'ruby-prof'
  gem 'rails-perftest'
  gem 'simplecov', '~> 0.7.1'
end

group :test do
  gem 'shoulda-matchers'
  gem 'capybara'
  gem "database_cleaner"
  gem 'selenium-webdriver'
  gem 'stripe-ruby-mock', '>= 1.8.7.4'
end
