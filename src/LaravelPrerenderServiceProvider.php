<?php
namespace Nutsweb\LaravelPrerender;

use Illuminate\Foundation\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class LaravelPrerenderServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    protected $package = 'ahtinurme/laravel-prerender';

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/prerender.php' => config_path('prerender.php')
        ], 'config');

        if (config('prerender.enable')) {
            /** @var Kernel $kernel */
            $appKernel = resolve(\App\Http\Kernel::class);
            $appKernel->pushMiddleware(PrerenderMiddleware::class);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/prerender.php', 'prerender');
    }

}
