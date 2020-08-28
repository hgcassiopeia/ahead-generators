<?php 

namespace Ahead\Generators\Console;

use Ahead\Generators\Console\BaseCommand;

class RepositoryCommand extends BaseCommand {

	protected $signature = 'ahead:repo
        {name : Name of the model.}
        {--table= : the table name.}
        {--fillable= : the fillable fields.}
        {--timestamps=true : enables timestamps on the model.}
        {--path=app/Models : where to store the model php file.}
    ';

	protected $description = 'Generates a model';

    public function handle()
    {
        $name = $this->argument('name');
        $path = $this->option('path');

        $content = $this->getTemplate('model')
            ->with([
                'name' => $name,
                'namespace' => $this->getNamespace(),
                'table' => $this->getTableName(),
                'fillable' => $this->getAsArrayFields('fillable'),
                'additional' => $this->getAdditional()
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

    protected function getTableName()
    {
        // dd($this->option('table'));
        return !empty($this->option('table'))
            ? "protected \$table = '".$this->option('table')."';" . PHP_EOL
            : '';
    }

    protected function getAdditional()
    {
        return $this->option('timestamps') == 'false'
            ? "public \$timestamps = false;" . PHP_EOL
            : '';
    }

    protected function getNamespace()
    {
    	return str_replace(' ', '\\', ucwords(str_replace('/', ' ', $this->option('path'))));
    }
}