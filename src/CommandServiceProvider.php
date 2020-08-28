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
}