# config valid only for current version of Capistrano
lock '3.4.0'

set :application, 'distribution'
set :repo_url, 'https://github.com/songlipeng2003/distribution.git'

# Default branch is :master
# ask :branch, `git rev-parse --abbrev-ref HEAD`.chomp

# Default deploy_to directory is /var/www/my_app_name
# set :deploy_to, '/var/www/my_app_name'

# Default value for :scm is :git
# set :scm, :git

# Default value for :format is :pretty
# set :format, :pretty

# Default value for :log_level is :debug
# set :log_level, :debug

# Default value for :pty is false
# set :pty, true

# Default value for :linked_files is []
set :linked_files, fetch(:linked_files, []).push('.env', 'composer.phar')

# Default value for linked_dirs is []
set :linked_dirs, fetch(:linked_dirs, []).push('runtime', 'web/assets', 'web/uploads')

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for keep_releases is 5
# set :keep_releases, 5

set :copy_files, ['vendor']

namespace :deploy do
  task :clear_cache do
    on roles(:app) do
      within release_path do
        execute "cd #{release_path} && ./yii cache/flush-all"
      end
    end
  end

  task :composer do
    on roles(:app) do
      within release_path do
        execute "cd #{release_path} && php composer.phar global require \"fxp/composer-asset-plugin:~1.1.1\""
        execute "cd #{release_path} && php composer.phar install"
      end
    end
  end

  task :migrate do
    on roles(:app) do
      within release_path do
        # execute "cd #{release_path} && ./yii migrate --migrationPath=@yii/rbac/migrations --interactive=0"
        # execute "cd #{release_path} && ./yii migrate --migrationPath=@mdm/admin/migrations --interactive=0"
        execute "cd #{release_path} && ./yii migrate/up --migrationPath=@vendor/costa-rico/yii2-images/migrations --interactive=0"
        execute "cd #{release_path} && ./yii migrate --migrationPath=@vendor/yii2mod/yii2-settings/migrations --interactive=0"
        execute "cd #{release_path} && ./yii migrate --interactive=0"
      end
    end
  end

  task :restart do 
    on roles(:app) do
      execute "service php7.0-fpm restart"
    end
  end

  after :updated, "deploy:composer"
  after :updated, "deploy:migrate"
  after :updated, "deploy:clear_cache"
  after :updated, "deploy:restart"
end