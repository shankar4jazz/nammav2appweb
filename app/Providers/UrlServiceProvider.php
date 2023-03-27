<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;

class UrlServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('url', function () {
        $generator = $this->app->getGenerator();

        $generator->forceScheme('https');

        return $generator;
    });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
         if (config('app.env') !== 'local') {
            $url->forceScheme('https');
        }
    }
}
