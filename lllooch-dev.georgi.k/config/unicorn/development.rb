rails_env = ENV['RAILS_ENV'] || 'development'
worker_processes Integer(ENV["WEB_CONCURRENCY"] || 3)
timeout 600

app_folder = "/var/www/lll/development/current"
working_directory app_folder

stderr_path app_folder + "/log/unicorn.stderr.log"
stdout_path app_folder + "/log/unicorn.stdout.log"

pid app_folder + "/tmp/pids/unicorn.pid"

listen app_folder + "/tmp/unicorn.sock", :backlog => 64
listen 8080, :tcp_nopush => true

preload_app true
GC.respond_to?(:copy_on_write_friendly=) and
  GC.copy_on_write_friendly = true

check_client_connection false  

before_fork do |server, worker|
  Signal.trap 'TERM' do
    puts 'Unicorn master intercepting TERM and sending myself QUIT instead'
    Process.kill 'QUIT', Process.pid
  end

  defined?(ActiveRecord::Base) and
    ActiveRecord::Base.connection.disconnect!
end 

after_fork do |server, worker|
  Signal.trap 'TERM' do
    puts 'Unicorn worker intercepting TERM and doing nothing. Wait for master to send QUIT'
  end

  defined?(ActiveRecord::Base) and
    ActiveRecord::Base.establish_connection
end