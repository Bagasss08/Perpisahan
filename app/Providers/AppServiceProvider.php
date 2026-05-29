<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    public function boot(UrlGenerator $url)
    {
        if (config('app.env') === 'production') {
            $url->forceScheme('https');
        }
    }
}