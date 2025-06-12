<?php

namespace App\Providers;

use App\Repositories\Interfaces\TodoRepositoryInterface;
use App\Repositories\TodoRepository;
use App\Services\Interfaces\TodoServiceInterface;
use App\Services\TodoService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // bind repositories
        $this->app->bind(TodoRepositoryInterface::class, TodoRepository::class);

        // bind services
        $this->app->bind(TodoServiceInterface::class, TodoService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
