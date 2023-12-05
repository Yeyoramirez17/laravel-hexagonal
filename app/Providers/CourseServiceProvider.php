<?php

namespace App\Providers;

use Core\BoundedContext\Course\Domain\Repository\CourseRepository;
use Core\BoundedContext\Course\Infrastructure\Persistence\Eloquent\CourseRepository as EloquentCourseRepository;
use Illuminate\Support\ServiceProvider;

class CourseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            abstract: CourseRepository::class,
            concrete: EloquentCourseRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
