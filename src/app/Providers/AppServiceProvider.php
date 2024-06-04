<?php

namespace App\Providers;

use App\Repositories\CandidateRepository;
use App\Repositories\UserRepository;
use App\Services\CandidateService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepository::class));
        });

        $this->app->bind(CandidateService::class, function ($app) {
            return new CandidateService($app->make(CandidateRepository::class));
        });
    }
}
