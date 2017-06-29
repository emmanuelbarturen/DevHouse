<?php namespace DevHouse\Console;

use Illuminate\Console\Command;

class RepositoryPattern extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DevHouse:pattern {name} {--manager=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'El mero patron del mal';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command
     */
    public function handle()
    {
        $name = $this->argument('name');
        $manager = $this->option('manager');

        if ($manager) {
            $manager = ucfirst($manager);
        } else {
            $manager = ucfirst($name);
        }

        // Migration \\
        $migrationName = 'create_' . strtolower(str_plural($name)) . '_table';
        $this->call('make:migration', ['name' => $migrationName, '--create' => strtolower(str_plural($name))]);

        // Seeder \\
        $seederName = str_plural($name) . 'TableSeeder';
        $this->call('make:seeder', ['name' => $seederName]);

        // Model and Repository \\
        $this->call('DevHouse:repo', ['modelName' => ucfirst($name), '--m' => 'default']);

        // Service \\
        $serviceName = str_singular(ucfirst($name));
        $this->call('DevHouse:service', ['modelName' => $serviceName]);

        // Controller \\
        $controllerName = $manager . '/' . str_plural(ucfirst($name)) . 'Controller';
        $this->call('make:controller',
            ['name' => $controllerName, '--resource' => 'default', '--model' => ucfirst($name)]);

        // Views \\
        $this->call('DevHouse:views', ['modelName' => $serviceName, '--manager' => $manager]);

        // Form Request \\
        $requestName = $manager . '/' . str_plural(ucfirst($name)) . 'FormRequest';
        $this->call('make:request', ['name' => $requestName]);

        $this->info('Listo chulls, te he ahorrado un culo de tiempo asi q ahora chambea ctv!!!');

    }

}
