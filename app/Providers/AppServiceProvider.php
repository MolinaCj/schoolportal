<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\URL;

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
        Schema::defaultStringLength(191);
        app(Schedule::class)->command('app:clean-old-login-attempts')->everyMinute();

        if(request()->server('HTTP_X_FORWARDED_PROTO') == 'https' || request()->server('HTTPS') == 'on') {
            \URL::forceScheme('https');
        }
    }
}
