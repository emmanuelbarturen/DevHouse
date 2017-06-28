<?php namespace DevHouse\Console;

use DevHouse\Helpers\FileManagerTrait;
use Illuminate\Console\Command;

class MakeService extends Command
{
    use FileManagerTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DevHouse:service {modelName} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea un servicio bajo el patrón REM';

    /**
     * Create a new command instance.
     *
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
        $template_service = __DIR__.'/../Stubs/service.stub';
        $fileName = $name . 'Service.php';
        $target_path_dir = app_path('Services');
        $servPath = $this->makeFile($fileName, $template_service, $target_path_dir, ['{{model}}' => $name]);
        $this->info('Servicio creado =>' . $servPath);
    }
}
