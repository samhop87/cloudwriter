<?php

namespace App\Providers;

use App\Interfaces\ChatGPTServiceInterface;
use App\Interfaces\DriveApiInterface;
use App\Interfaces\DriveConnectionInterface;
use App\Interfaces\ProjectServiceInterface;
use App\Services\ChatGPTService;
use App\Services\GoogleDriveApiService;
use App\Services\GoogleDriveConnectionService;
use App\Services\ProjectService;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

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
        $this->app->bind(ChatGPTServiceInterface::class, ChatGPTService::class);
        $this->app->bind(ProjectServiceInterface::class, ProjectService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::share('errors', function () {
            return session()->get('errors') ? session()->get('errors')->getBag('default')->getMessages() : (object) [];
        });
    }
}
