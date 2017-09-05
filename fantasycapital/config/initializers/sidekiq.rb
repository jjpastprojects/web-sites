redis_url = ENV["REDISCLOUD_URL"] || ENV["OPENREDIS_URL"] || ENV["REDISGREEN_URL"] || ENV["REDISTOGO_URL"] || 'redis://localhost:6379'

Sidekiq.configure_server do |config|
    config.redis = { :url => redis_url, :namespace => 'sidekiq' }

    # specify number of connections. This should match or exceed # of simultaneous threads
    # of the sidekiq process (as specified in Procfile).
    # NOTE that heroku PostGres plans limit # of connections. "hobby-basic" that we're 
    # on allows 20 total, which need to be shared between different dynos.
    sidekiq_pool = ENV['SIDEKIQ_DB_POOL'] || 10

    # from
    # http://stackoverflow.com/questions/18899464/possible-to-avoid-activerecordconnectiontimeouterror-on-heroku
    if defined?(ActiveRecord::Base)
        Rails.logger.debug("Setting custom connection pool size of #{sidekiq_pool} for Sidekiq Server")
        config = Rails.application.config.database_configuration[Rails.env]
        config['reaping_frequency'] = ENV['DB_REAP_FREQ'] || 10 # seconds
        config['pool']              = sidekiq_pool
        ActiveRecord::Base.establish_connection(config)

        Rails.logger.info("Connection pool size for Sidekiq Server is now: #{ActiveRecord::Base.connection.pool.instance_variable_get('@size')}")
        puts "Connection pool size is #{ActiveRecord::Base.connection.pool.instance_variable_get('@size')}"
    end

end

Sidekiq.configure_client do |config|
    config.redis = { :url => redis_url, :namespace => 'sidekiq' }
end
