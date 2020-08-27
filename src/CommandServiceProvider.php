<?php 

namespace Ahost\Generators;

use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider {

   /**
    * Bootstrap the application services.
    *
    * @return void
    */
   public function boot()
   {
   }

   protected $commands = [
      \Ahost\Generators\Console\InstallBlogPackage::class
  ];

   /**
    * Register the application services.
    *
    * @return void
    */
   public function register()
   {
      $this->commands($this->commands);
  }

}