<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $baseUrl = env('DEEZER_ENDPOINT');
        $this->app->singleton(Client::class, function($app) use ($baseUrl) {
            return new Client(['base_uri' => $baseUrl]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
