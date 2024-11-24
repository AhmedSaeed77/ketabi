<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            if (app()->environment(['production'])) {
                Route::group(['middleware' => 'localizeApi'], function () {
                    Route::prefix('v1/w')
                        ->domain(env('PRODUCTION_API_SUBDOMAIN'))
                        ->middleware('api')
                        ->namespace($this->namespace)
                        ->group(base_path('routes/api/v1/website.php'));

                    Route::prefix('v1/m')
                        ->domain(env('PRODUCTION_API_SUBDOMAIN'))
                        ->middleware('api')
                        ->namespace($this->namespace)
                        ->group(base_path('routes/api/v1/mobile.php'));
                });

                Route::middleware('web')
                    ->domain(env('PRODUCTION_DASHBOARD_SUBDOMAIN'))
                    ->namespace($this->namespace)
                    ->group(base_path('routes/dashboard.php'));
            } else {
                Route::group(['middleware' => 'localizeApi'], function () {
                    Route::middleware('api')
                        ->prefix('api/v1/w')
                        ->group(base_path('routes/api/v1/website.php'));

                    Route::middleware('api')
                        ->prefix('api/v1/m')
                        ->group(base_path('routes/api/v1/mobile.php'));
                });

                Route::middleware('web')
                    ->group(base_path('routes/dashboard.php'));
            }
        });
    }
}
