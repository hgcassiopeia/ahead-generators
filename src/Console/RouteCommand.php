<?php 

namespace Ahead\Generators\Console;

use Ahead\Generators\Console\BaseCommand;

class RouteCommand extends BaseCommand {

	protected $signature = 'ahead:route
		{resource : Name of the resource (URI).}
        {--controller= : Name of the RESTful controller.}
        {--laravel=false : Use Laravel style route definitions}
    ';

	protected $description = 'Generates RESTful routes.';

    public function handle()
    {
        $resource = $this->getResource();
        $laravelRoutes = $this->option('laravel') === "true" ? true: false;
        $templateFile = 'routes';
        $routesPath = 'routes/web.php';
        
        if ($laravelRoutes == true) {
            $templateFile = 'routes-laravel';
            $routesPath = 'routes/api.php';
            if (!$this->fs->isFile($routesPath)) {
                if (!$this->fs->isDirectory('./routes')) {
                    $this->fs->makeDirectory('./routes');
                }
                $this->fs->put($routesPath, "
<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the \"api\" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request \$request) {
    return \$request->user();
});
            ");
            }
        }

        $content = $this->fs->get($routesPath);
        
        $content .= PHP_EOL . $this->getTemplate($templateFile)
                ->with([
                    'resource' => $resource,
                    'controller' => $this->getController()
                ])
                ->get();
        $this->save($content, $routesPath, "{$resource} routes", true);
    }

    protected function getResource()
    {
        return strtolower($this->argument('resource'));
    }

    protected function getController()
    {
        $controller = $this->option('controller');
        if(!$controller){
            $controller = ucwords(strtolower($this->argument('resource'))) . 'Controller';
        }
        else{
            $controller = $controller . 'Controller';
        }
        return $controller;
    }

}