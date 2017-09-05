
set :default_env, { path: '/usr/local/bin:$PATH' }

set :application, 'braintrust'
set :repo_url, 'git@github.com:jaredhughes/braintrustgroup.com.git'

# Use :debug for more verbose output when troubleshooting
set :log_level, :debug

set :linked_files, fetch(:linked_files, []).push('.env', 'web/.htaccess')
set :linked_dirs, fetch(:linked_dirs, []).push(
  'web/app/cache',
  'web/app/uploads',
  'web/app/mu-plugins',
  'web/app/plugins',
  'web/app/w3tc-config',
  'web/wp/assets'
)

set :copy_exclude, [
  ".git",
  ".gitignore",
  ".sass-cache",
  "gulpfile.js",
  "package.json",
  "Capfile",
  "Capfile-bak",
  "README.md",
  'web/wp/assets'
]

namespace :deploy do
  desc 'Update WordPress template root paths to point to the new release'
  task :update_option_paths do
    on roles(:app) do
      within fetch(:release_path) do
        if test :wp, :core, 'is-installed'
          [:stylesheet_root, :template_root].each do |option|
            # Only change the value if it's an absolute path
            # i.e. The relative path "/themes" must remain unchanged
            # Also, the option might not be set, in which case we leave it like that
            value = capture :wp, :option, :get, option, raise_on_non_zero_exit: false
            if value != '' && value != '/themes'
              execute :wp, :option, :set, option, fetch(:release_path).join('web/wp/wp-content/themes')
            end
          end
        end
      end
    end
  end
end

task :setperms do
  on roles(:web) do
    execute "chmod 755 #{deploy_to}/current/web/wp/assets"
  end
end

# The above update_option_paths task is not run by default
# Note that you need to have WP-CLI installed on your server
# Uncomment the following line to run it on deploys if needed
after 'deploy:publishing', 'deploy:update_option_paths'

#after 'deploy:publishing', :setperms
