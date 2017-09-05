set :stage, :staging

role :app, %w{}
role :web, %w{}
role :db, %w{}

set :deploy_to, '/home/ai/ai1/staging.braintrustgroup.com'

set :branch, :staging

server 'aiws1.onyxlight.net', user: 'ai', roles: %w{web app db}

fetch(:default_env).merge!(wp_env: :staging)
