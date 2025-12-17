<?php

namespace App\Providers;

use App\Services\Impl\CategoryServiceImpl;
use Illuminate\Support\ServiceProvider;
use App\Services\CategoryService;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CategoryService::class, function ($app) {
            return new CategoryServiceImpl();
        });
    }

    public function provides(): array
    {
        return [
            CategoryService::class
        ];
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
