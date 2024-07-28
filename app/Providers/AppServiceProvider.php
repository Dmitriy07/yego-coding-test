<?php

namespace App\Providers;

use App\ExternalServices\Transport;
use App\ExternalServices\Yego\YegoApi;
use App\Repositories\Eloquent\RideRepository;
use App\Repositories\Eloquent\ScooterRepository;
use App\Repositories\Eloquent\ScooterStatusRepository;
use App\Repositories\Ride;
use App\Repositories\Scooter;
use App\Repositories\ScooterStatus;
use App\Services\DistanceCalculator;
use App\Services\Ride as RideService;
use App\Services\Scooter as ScooterService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Ride::class, RideRepository::class);
        $this->app->bind(RideService::class, function ($app) {
            return new RideService($app->make(Ride::class));
        });

        $this->app->bind(Scooter::class, ScooterRepository::class);
        $this->app->bind(ScooterStatus::class, ScooterStatusRepository::class);
        $this->app->bind(Transport::class, YegoApi::class);
        $this->app->bind(ScooterService::class, function ($app) {
            return new ScooterService(
                $app->make(Scooter::class),
                $app->make(ScooterStatus::class),
                $app->make(Ride::class),
                $app->make(Transport::class),
                $app->make(DistanceCalculator::class),
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
