<?php

namespace App\Providers;

use Core\Shared\Domain\Utils\UuidGenerator;
use Core\Shared\Infrastructure\Util\RamseyUuidGenerator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            abstract: UuidGenerator::class,
            concrete: RamseyUuidGenerator::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(
            base_path("src/BoundedContext/**/Infrastructure/migrations" )
        );
    }
}
