<?php

namespace App\Providers;

use App\Repositories\ConfigurationRepository;
use App\Repositories\Interfaces\ConfigurationRepositoryInterface;
use App\Repositories\LogRepository;
use App\Repositories\Interfaces\LogRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ConfigurationRepositoryInterface::class, 
            ConfigurationRepository::class
        );
        $this->app->bind(
            LogRepositoryInterface::class, 
            LogRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {}
}
