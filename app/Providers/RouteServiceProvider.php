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
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

//        $this->routes(function () {
//
//        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    public function map()
    {
        $this->mapApiRoutes();
        $this->mapCommonRoutes();
        $this->mapWebRoutes();
        $this->mapTestRoutes();	#调用上面的方法
    }

    //web后台
    protected function mapWebRoutes()
    {
        Route::prefix('admin')
            ->middleware('admin')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }

    //api
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    //common
    protected function mapCommonRoutes()
    {
        Route::prefix('common')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/common.php'));
    }

    //test
    protected function mapTestRoutes()
    {
        Route::namespace($this->namespace)
            ->group(base_path('routes/test.php'));
    }
}
