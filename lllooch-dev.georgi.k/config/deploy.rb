# стандартный deploy для рельсового проекта
require "rvm/capistrano"
require 'sidekiq/capistrano'

set :rvm_ruby_string, :local              # use the same ruby as used locally for deployment
set :rvm_autolibs_flag, "read-only"       # more info: rvm help autolibs

before 'deploy:setup', 'rvm:install_rvm'  # install RVM
before 'deploy:setup', 'rvm:install_ruby'

set :stages, %w(production development)
set :default_stage, 'development'

require 'capistrano/ext/multistage'

set(:unicorn_env) { rails_env }

set :application, 'cms'
set :repository, 'git@bitbucket.org:cslstudio/lll.git'
set :deploy_via, :remote_cache


set :user, 'deploy'
set :use_sudo, false
set :project_path, "/var/www/lll/"
set (:deploy_to) { "/var/www/lll/#{stage_name}/" }
set (:ts) { 
  d = DateTime.now
  d.strftime("%Y%m%d%H%M%S") 
}

set :whenever_command, 'rvm use 2.0.0-p247 do bundle exec whenever'

set :scm, :git
set :ssh_options, { :forward_agent => true }

set :keep_releases, 5
after "deploy:restart", "deploy:cleanup" 

require 'bundler/capistrano'
#require "thinking_sphinx/deploy/capistrano"
#require "whenever/capistrano"

#before 'deploy:finalize_update', :copy_database_config - I made my own #, :copy_email_config - was before me
before 'deploy:stop', 'deploy:lock'
after 'deploy:start', 'deploy:unlock'


before 'deploy:finalize_update' do
  run "rm -f #{release_path}/config/database.yml"
  run "ln -s #{shared_path}/config/database.yml #{release_path}/config/database.yml"
  run "ln -s #{shared_path}/uploads #{release_path}/public/uploads"
end

#task :copy_database_config, roles => :app do - was before me
#  db_config = "#{shared_path}/database.yml"
#  run "cp #{db_config} #{release_path}/config/database.yml"
#end

#task :copy_email_config, roles => :app do
#  mail_config = "#{shared_path}/email.yml"
#  run "cp #{mail_config} #{release_path}/config/email.yml"
#end

set (:unicorn_conf) {"./config/unicorn/#{stage_name}.rb"}
set (:unicorn_pid) {"#{shared_path}/pids/unicorn.pid"}
set (:unicorn_start_cmd) {"(cd #{deploy_to}current; rvm use 2.0.0-p247 do bundle exec unicorn_rails -Dc #{unicorn_conf} -E #{unicorn_env})"}

set :bundle_cmd, 'rvm use 2.0.0-p247 do bundle'


# - for unicorn - #
namespace :deploy do
  desc "Locks working copy"
  task :lock do
    run "cd #{deploy_to}current; echo '' > .lock"
  end

  desc "Unlocks working copy"
  task :unlock do
    run "cd #{deploy_to}current; rm .lock"
  end

  desc 'Start application'
  task :start, :roles => :app do
    run unicorn_start_cmd
  end

  desc "reload the database with seed data"
  task :seed do
    run "cd #{current_path}; RAILS_ENV=#{rails_env} bundle exec rake db:seed"
  end

  desc "drop the database"
  task :db_drop do
    run "cd #{current_path}; RAILS_ENV=#{rails_env} bundle exec rake db:drop"
  end

  desc "create the database"
  task :db_create do
    run "cd #{current_path}; RAILS_ENV=#{rails_env} bundle exec rake db:create"
  end

  desc "create symlink to uploads"
  task :uploads do
    run "cd #{current_path}/public; rm -rf uploads; ln -s #{deploy_to}shared/uploads"
  end

  desc "dump uploads"
  task :dump_uploads do
    run "mkdir -p #{project_path}dumps/uploads/#{ts}; cp -r #{deploy_to}shared/uploads #{project_path}dumps/uploads/#{ts}"
  end

  desc "show routes"
  task :routes do
    run "cd #{current_path}/public; bundle exec rake routes RAILS_ENV=#{rails_env}"
  end

  desc 'Stop application'
  task :stop, :roles => :app do
    run "[ -f #{unicorn_pid} ] && kill -QUIT `cat #{unicorn_pid}`"
  end

  desc 'Restart Application'
  task :restart, :roles => :app do
    run "[ -f #{unicorn_pid} ] && kill -USR2 `cat #{unicorn_pid}` || #{unicorn_start_cmd}"
  end
end


set :max_asset_age, 2 ## Set asset age in minutes to test modified date against.

namespace :deploy do
  namespace :assets do

    desc 'Figure out modified assets.'
    task :determine_modified_assets, :roles => assets_role, :except => { :no_release => true } do
      set :updated_assets, capture("find #{latest_release}/app/assets -type d -name .git -prune -o -mmin -#{max_asset_age} -type f -print", :except => { :no_release => true }).split
    end

    desc 'Remove callback for asset precompiling unless assets were updated in most recent git commit.'
    task :conditionally_precompile, :roles => assets_role, :except => { :no_release => true } do
      if(updated_assets.empty?)
        callback = callbacks[:after].find{|c| c.source == 'deploy:assets:precompile' }
        callbacks[:after].delete(callback)
        logger.info('Skipping asset precompiling, no updated assets.')
      else
        logger.info("#{updated_assets.length} updated assets. Will precompile.")
      end
    end
    
  end
end

namespace :deploy do
  desc "cleanup"
  task :cleanup, :roles => :app do
    run "cd #{deploy_to}current; RAILS_ENV=#{rails_env} bundle exec rake lllooch:cleanup"
  end

  desc 'Dellin cities cache'
  task :dellin_cities, roles: :app do
    run "cd #{deploy_to}current; RAILS_ENV=#{rails_env} bundle exec rake dellin:cities"
  end

  desc 'DPD cities cache'
  task :dpd_cities, roles: :app do
    run "cd #{deploy_to}current; RAILS_ENV=#{rails_env} bundle exec rake dpd:cities"
  end

  namespace :paperclip do
    desc "build missing paperclip styles"
    task :missing, :roles => :app do
      run "cd #{deploy_to}current; RAILS_ENV=#{rails_env} bundle exec rake paperclip:refresh:missing_styles"
    end

    desc "regenerate 3d-previews"
    task :three60, :roles => :app do
      run "cd #{deploy_to}current; RAILS_ENV=#{rails_env} bundle exec rake paperclip:refresh CLASS=Three60"
    end

    desc "regenerate goods images"
    task :goods, :roles => :app do
      run "cd #{deploy_to}current; RAILS_ENV=#{rails_env} bundle exec rake paperclip:refresh CLASS=Good"
    end
  end
end

after 'deploy:finalize_update', 'deploy:assets:determine_modified_assets', 'deploy:assets:conditionally_precompile', "deploy:uploads"