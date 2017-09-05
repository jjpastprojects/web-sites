role :web, 'dev.lllooch.ru' # Your HTTP server, Apache/etc
role :app, 'dev.lllooch.ru' # This may be the same as your `Web` server
role :db,  'dev.lllooch.ru', :primary => true        # This is where Rails migrations will run

set :branch, 			'pristine'
set :repository_branch, 'pristine'
set :stage_name, 		'development'
set :unicorn_env,   'production'
set :rails_env, 		'production'