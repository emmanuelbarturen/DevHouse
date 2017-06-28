<?php namespace DevHouse;

use DevHouse\Console\MakeRepository;
use DevHouse\Console\MakeService;
use DevHouse\Console\MakeViews;
use DevHouse\Console\RepositoryPattern;

class DevHouseServiceProvider extends \Illuminate\Support\ServiceProvider{


    public function boot()
    {
        $this->app->singleton('DevHouse', function ($app) {
            return $app->make('DevHouse');
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeRepository::class,
                MakeService::class,
                MakeViews::class,
                RepositoryPattern::class
            ]);
        }
    }

}