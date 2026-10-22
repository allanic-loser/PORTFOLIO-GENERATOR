<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (app()->environment('local') && request()->hasHeader('x-forwarded-host')) {
            URL::forceRootUrl('https://' . request()->header('x-forwarded-host'));
            URL::forceScheme('https');
        }
    }
}
