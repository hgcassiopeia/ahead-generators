<?php 

namespace Ahead\Generators\Console;

use Ahead\Generators\Console\BaseCommand;

class ResourceCommand extends BaseCommand {

	protected $signature = 'ahead:rsc
        {name : Name of the resource.}
        {--path=app/Resources : where to store the resource php file.}
    ';

	protected $description = 'Generates a resource';

    public function handle()
    {
        $name = $this->argument('name');
        $path = $this->option('path');

        $content = $this->getTemplate('resource')
            ->with([
                'name' => $name,
                'namespace' => $this->getNamespace()
            ])
            ->get();
        
        $this->save($content, "./{$path}/{$name}.php", "{$name} resource");
    }

    protected function getNamespace()
    {
    	return str_replace(' ', '\\', ucwords(str_replace('/', ' ', $this->option('path'))));
    }
}