<?php

namespace App\Providers;

use App\Views\Composers\PermissionsComposer;
use App\Views\Composers\RolesComposer;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['dashboard.core.includes.sidebar'], RolesComposer::class);
        view()->composer(['dashboard.core.includes.sidebar'], PermissionsComposer::class);
    }
}
