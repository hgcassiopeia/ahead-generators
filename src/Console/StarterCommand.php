<?php 

namespace Ahead\Generators\Console;

use Ahead\Generators\Console\BaseCommand;

class StarterCommand extends BaseCommand {

	protected $signature = 'ahead:start
        {name : Name of the resource.}
    ';

	protected $description = 'Generates a model, repository, resource, controller and routes for RESTful resource';

    public function handle()
    {
        $name = $this->getPascalName();
        $modelName = ucwords(strtolower($name));
        $tableName = ucwords(strtolower($name));

        // generating the model
        $this->call('ahead:model', [
            'name' => $modelName,
            '--table' => $tableName
        ]);

        // generating the resource
        $this->call('ahead:rsc', [
            'name' => $name
        ]);

        // generating the repository
        $this->call('ahead:repo', [
            'name' => $name
        ]);

        // generating the controller
        $this->call('ahead:ctrl', [
            'name' => $name
        ]);
        
        $resourceUri = $this->getResourceUri();
        // generating the route
        $this->call('ahead:route', [
            'resource' => $resourceUri,
            '--controller' => $name."Controller"
        ]);
    }

    protected function getResourceUri()
    {
        return strtolower($this->argument('name'));
    }

    protected function getPascalName()
    {
        return ucwords(strtolower($this->argument('name')));
    }

    protected function getNamespace()
    {
    	return str_replace(' ', '\\', ucwords(str_replace('/', ' ', $this->option('path'))));
    }
}