Main::Application.configure do
  # Settings specified here will take precedence over those in config/application.rb.

  # In the development environment your application's code is reloaded on
  # every request. This slows down response time but is perfect for development
  # since you don't have to restart the web server when you make code changes.
  config.cache_classes = false

  # Do not eager load code on boot.
  config.eager_load = false

  # Show full error reports and disable caching.
  config.consider_all_requests_local       = true
  config.action_controller.perform_caching = false

  # Don't care if the mailer can't send.
  config.action_mailer.raise_delivery_errors = false

  # Print deprecation notices to the Rails logger.
  config.active_support.deprecation = :log

  # Raise an error on page load if there are pending migrations
  config.active_record.migration_error = :page_load

  # Debug mode disables concatenation and preprocessing of assets.
  # This option may cause significant delays in view rendering with a large
  # number of complex assets.
  config.assets.debug = false

  # Allow log level to be configured via env variable (and thus heroku CLI)
  config.log_level = ENV['LOG_LEVEL'] ? ENV['LOG_LEVEL'].to_sym : ('info').to_sym

  # Force SSL on site - user can login in from front page ==> need sure front page.
  config.force_ssl = true

  # use 'fingerprint' versioning in static assets to make them CDN-friendly. NOTE: This is actually
  # 'true' in production by default already, but this file is also included by 'staging.rb' so I
  # set the flag here to be explicit.
  config.assets.digest = true

  # don't compile assets at runtime if they don't already exist. This is necessary for rack-zippy
  #  to serve files, a la https://github.com/eliotsykes/rack-zippy/issues/12
  config.assets.compile = false

  # static assets control and expiry
  config.serve_static_assets = true
  config.static_cache_control = 'public, max-age=3600' # 1 hour, temporarily
  #config.static_cache_control = 'public, max-age=31536000' # 1 year

  # Host for static assets in PRODUCTION environment - Amazon CloudFront (thru AWS panel)
  config.action_controller.asset_host = "d1d2dib6t3chcj.cloudfront.net"

end
Rails.configuration.balanced_marketplace_uri = "/v1/marketplaces/TEST-MPEO3uigheQUEL2WW6VnaCQ"
Rails.configuration.projection_notif_email = "ammanncapital@gmail.com"
Rails.configuration.app_name = "fantasycapital"
