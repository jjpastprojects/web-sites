# serve precompressed assets (.gz files) directly for static assets using rack-zippy gem.
Rails.application.config.middleware.swap(ActionDispatch::Static, Rack::Zippy::AssetServer,
                                         Rails.public_path)

# Rack-Zippy is what we use to serve static assets from gunicorn (in Heroku, static assets are
# served directly by the webserver). Modified regex to add woff, eot, ttf
module Rack
  module Zippy
    class AssetServer
      remove_const(:STATIC_EXTENSION_REGEX)
      STATIC_EXTENSION_REGEX = /\.(?:css|js|html|htm|txt|ico|png|jpg|jpeg|gif|pdf|svg|zip|gz|eps|psd|ai|woff|eot|ttf)\z/i

    end
  end
end