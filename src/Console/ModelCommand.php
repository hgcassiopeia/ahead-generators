<?php 

namespace Ahead\Generators\Console;

use Ahead\Generators\Console\BaseCommand;

class ModelCommand extends BaseCommand {

	protected $signature = 'ahead:model
        {name : Name of the model.}
        {--timestamps=true : enables timestamps on the model.}
        {--path=app : where to store the model php file.}
        {--parsed : tells the command that arguments have been already parsed. To use when calling the command from an other command and passing the parsed arguments and options}
        {--force= : override the existing files}
    ';

	protected $description = 'Generates a model class for a RESTfull resource';

    public function handle()
    {
        $name = $this->argument('name');
        $path = $this->option('path');

        $content = $this->getTemplate('model')
            ->with([
                'name' => $name,
                'namespace' => $this->getNamespace(),
                'fillable' => $this->getAsArrayFields('fillable'),
                'additional' => $this->getAdditional(),
            ])
            ->get();

        $this->save($content, "./{$path}/{$name}.php", "{$name} model");
    }

    protected function getAsArrayFields($arg, $isOption = true)
    {
    	$arg = ($isOption) ? $this->option($arg) : $this->argument($arg);
        if(is_string($arg)){
        	$arg = explode(',', $arg);
        } else if(! is_array($arg)) {
            $arg = [];
        }
        return implode(', ', array_map(function($item){
            return '"' . $item . '"';
        }, $arg));
    }

    protected function getAdditional()
    {
        return $this->option('timestamps') == 'false'
            ? "    public \$timestamps = false;" . PHP_EOL . PHP_EOL
            : '';
    }

    protected function getNamespace()
    {
    	return str_replace(' ', '\\', ucwords(str_replace('/', ' ', $this->option('path'))));
    }
}