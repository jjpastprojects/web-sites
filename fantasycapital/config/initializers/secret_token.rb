# Be sure to restart your server when you modify this file.

# Your secret key for verifying the integrity of signed cookies.
# If you change this key, all old signed cookies will become invalid!
# Make sure the secret is at least 30 characters and all random,
# no regular words or you'll be exposed to dictionary attacks.

# from http://daniel.fone.net.nz/blog/2013/05/20/a-better-way-to-manage-the-rails-secret-token/
#
# In production and staging, secret token should be set in environment, using :
#  heroku config:set SECRET_KEY_BASE=$(rake secret)
# 
# Note this will invalidate existing sessions, so only regen if necessary or creating a
# new env.
Main::Application.config.secret_key_base = if Rails.env.development? or Rails.env.test?
    puts "** Insecure token in use **"
    ('x' * 30) # meets minimum requirement of 30 chars long
  else
    ENV['SECRET_TOKEN']
  end
