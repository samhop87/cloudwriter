<?php

namespace App\Providers;

use App\Interfaces\DriveApiInterface;
use App\Interfaces\DriveConnectionInterface;
use App\Services\GoogleDriveApiService;
use App\Services\GoogleDriveConnectionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DriveApiInterface::class, GoogleDriveApiService::class);
        $this->app->bind(DriveConnectionInterface::class, GoogleDriveConnectionService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
