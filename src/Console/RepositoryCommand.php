<?php 

namespace Ahead\Generators\Console;

use Ahead\Generators\Console\BaseCommand;

class RepositoryCommand extends BaseCommand {

	protected $signature = 'ahead:repo
        {name : Name of the repository.}
        {--model= : the model class name has relationships with this repository.}
        {--path=app/Repositories : where to store the model repository file.}
        {--force= : override the existing files}
    ';

	protected $description = 'Generates a repository';

    public function handle()
    {
        $name = $this->argument('name');
        $model = empty($this->option('model')) ? $name : $this->option('model');
        $path = $this->option('path');
        
        $content = $this->getTemplate('repository')
            ->with([
                'name' => $name,
                'model' => $model,
                'namespace' => $this->getNamespace()
            ])
            ->get();
        
        $this->getBaseRepository("./{$path}/BaseRepository.php");
        $this->save($content, "./{$path}/{$name}Repository.php", "{$name} repository");
    }

    protected function getBaseRepository($path)
    {
        $fileExists = $this->checkFileExists($path);
        if(!$fileExists){
            $content = $this->getTemplate('BaseRepository')
            ->with([
                'namespace' => $this->getNamespace()
            ])
            ->get();
            $this->save($content, $path, "Base repository");
        }
    }

    protected function getNamespace()
    {
    	return str_replace(' ', '\\', ucwords(str_replace('/', ' ', $this->option('path'))));
    }
}