<?php namespace DevHouse\Console;

use DevHouse\Helpers\FileManagerTrait;
use Illuminate\Console\Command;

class MakeViews extends Command
{
    use FileManagerTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DevHouse:views {modelName} {--manager=} {--layout=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea un vistas CRUD bajo el patrón REM ';

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
        $views = ['index', 'create', 'edit', 'show'];
        $template_views = __DIR__.'/../Stubs/view.stub';
        $name = $this->argument('modelName');
        $manager = $this->option('manager');
        $layout = $this->option('layout');

        if (!$layout) {
            $layout = 'layouts.' . strtolower($name);
        }

        if ($manager) {
            $target_path_dir = resource_path('views/' . strtolower($manager) . '/' . strtolower($name));
        } else {
            $target_path_dir = resource_path('views');
        }

        foreach ($views as $view) {
            $fileName = $view . '.blade.php';
            $this->makeFile($fileName, $template_views, $target_path_dir, ['{{layout}}' => strtolower($layout)]);
        }

        return $target_path_dir;
    }
}
