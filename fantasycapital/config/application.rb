require File.expand_path('../boot', __FILE__)

require 'rails/all'

# Require the gems listed in Gemfile, including any gems
# you've limited to :test, :development, or :production.
Bundler.require(:default, Rails.env)

module Main
  class Application < Rails::Application
    # Settings in config/environments/* take precedence over those specified here.
    # Application configuration should go into files in config/initializers
    # -- all .rb files in that directory are automatically loaded.

    # Set Time.zone default to the specified zone and make Active Record auto-convert to this zone.
    # Run "rake -D time" for a list of tasks for finding time zone names. Default is UTC.
    # config.time_zone = 'Central Time (US & Canada)'

    # The default locale is :en and all translations from config/locales/*.rb,yml are auto loaded.
    # config.i18n.load_path += Dir[Rails.root.join('my', 'locales', '*.{rb,yml}').to_s]
    # config.i18n.default_locale = :de

    config.autoload_paths += %W(#{config.root}/services)
    config.assets.paths << Rails.root.join('app', 'assets', 'fonts')
    # Apparently the below is wrong (was causing ttf / woff not to be found). 
    # See
    # http://stackoverflow.com/questions/10905905/using-fonts-with-rails-asset-pipeline, 
    #   and especially comment below first answer.
    #config.assets.precompile += %w( .svg .eot .woff .ttf )

    potential_sports = {NBA: {api_client: SportsdataClient::Sports::NBA},
                     MLB: {api_client: SportsdataClient::Sports::MLB}
    }

    # choose sports which are enabled for projections based on an environment variable. Default
    #  value should be all sports.
    enabled_sports = (ENV['SPORTS'] || "MLB,NBA").split","
    config.sports = {}
    enabled_sports.each { |sportname|
      config.sports[sportname.to_sym] = potential_sports[sportname.to_sym]
    }
    config.generators do |g|
      g.test_framework :rspec, fixture: true
      g.fixture_replacement :factory_girl, dir: "spec/factories"
    end

    # set rails timezone to UTC so that silly things like Time.now are consistent
    # between dev environment, staging, and prod.
    # We should explicitly map to timezones where we need it.
    ENV['TZ'] = 'UTC'

  end
end
