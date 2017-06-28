<?php namespace DevHouse\Console;

use DevHouse\Helpers\FileManagerTrait;
use Illuminate\Console\Command;

class MakeRepository extends Command
{
    use FileManagerTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DevHouse:repo {modelName} {--m}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea un repositorio bajo el patrón REM';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('modelName');
        $model = $this->option('m');

        if ($model) {
            $modelName = 'Repositories/' . str_singular(ucfirst($name)) . '/' . ucfirst($name);
            $this->call('make:model', ['name' => $modelName]);
            $this->info('Modelo ' . $name . ' creado => Repositories/' . ucfirst($name) . '/' . ucfirst($name));
        }

        $template_repo = __DIR__.'/../Stubs/repository.stub';
        $fileName = $name . 'Repository.php';
        $target_path_dir = app_path('Repositories/' . $name);
        $repoPath = $this->makeFile($fileName, $template_repo, $target_path_dir, ['{{name}}' => ucfirst($name)]);
        $this->info('Repositorio creado =>' . $repoPath);
    }
}
