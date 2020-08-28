<?php 

namespace Ahead\Generators\Console;

use Ahead\Generators\Console\BaseCommand;

class ControllerCommand extends BaseCommand {

	protected $signature = 'ahead:ctrl
        {name : Name of the controller.}
        {--model= : the model class name has relationships with this controller.}
        {--resource= : the resource class name has relationships with this controller.}
        {--repository= : the repository class name has relationships with this controller.}
        {--path=app/Http/Controllers : where to store the controller php file.}
        {--force= : override the existing files}
    ';

	protected $description = 'Generates a controller';

    public function handle()
    {
        $name = $this->argument('name');
        $variable = strtolower($name);
        $model = empty($this->option('model')) ? $name : $this->option('model');
        $resource = empty($this->option('resource')) ? $name."Resource" : $this->option('resource')."Resource";
        $repository = empty($this->option('repository')) ? $name."Repository" : $this->option('repository')."Repository";
        $path = $this->option('path');
        
        $content = $this->getTemplate('controller')
            ->with([
                'name' => $name,
                'variable' => $variable,
                'model' => $model,
                'resource' => $resource,
                'repository' => $repository,
                'namespace' => $this->getNamespace()
            ])
            ->get();
        
        $this->save($content, "./{$path}/{$name}Controller.php", "{$name} controller");
    }

    protected function getNamespace()
    {
    	return str_replace(' ', '\\', ucwords(str_replace('/', ' ', $this->option('path'))));
    }
}