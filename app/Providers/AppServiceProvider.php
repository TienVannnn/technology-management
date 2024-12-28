<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\SupportRequest;
use App\Observers\RequestObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\PermissionRegistrar;

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
        Paginator::useBootstrap();
        app(PermissionRegistrar::class)->setPermissionClass(Permission::class);
        SupportRequest::observe(RequestObserver::class);
    }
}
