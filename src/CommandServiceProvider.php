<?php 

namespace Ahead\Generators;

use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider 
{
   /**
    * Register the application services.
    *
    * @return void
    */
   public function register()
   {
      $this->registerModelCommand();
      $this->registerResourceCommand();
      $this->registerRepositoryCommand();
      $this->registerControllerCommand();
   }

   protected function registerModelCommand(){
      $this->app->singleton('command.ahead.model', function($app){
          return $app['Ahead\Generators\Console\ModelCommand'];
      });
      $this->commands('command.ahead.model');
   }

   protected function registerResourceCommand(){
      $this->app->singleton('command.ahead.resource', function($app){
          return $app['Ahead\Generators\Console\ResourceCommand'];
      });
      $this->commands('command.ahead.resource');
   }

   protected function registerRepositoryCommand(){
      $this->app->singleton('command.ahead.repository', function($app){
          return $app['Ahead\Generators\Console\RepositoryCommand'];
      });
      $this->commands('command.ahead.repository');
   }

   protected function registerControllerCommand(){
      $this->app->singleton('command.ahead.controller', function($app){
          return $app['Ahead\Generators\Console\ControllerCommand'];
      });
      $this->commands('command.ahead.controller');
   }
}