if Rails.env.production? or Rails.env.staging?
  Airbrake.configure do |config|
    config.api_key = 'a847c662a8ed86b96b30e146364d6e7a'

    # SigTerm is sent by heroku to shut down tasks. It's not really an error.
    config.ignore << 'SignalException: SIGTERM'
  end
end
