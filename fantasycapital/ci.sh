#!/bin/bash

[[ -s "$HOME/.rvm/scripts/rvm" ]] && source "$HOME/.rvm/scripts/rvm" # Load RVM into a shell session *as a function*

rvm use 2.0.0
bundle install
export RAILS_ENV=test
bundle exec rake db:schema:load
bundle exec rake db:test:prepare
bundle exec rspec && bundle exec rake jasmine:ci
