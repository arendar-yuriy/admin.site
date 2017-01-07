<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(\LaravelLocalization::getCurrentLocale());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \App::register(ComposerServiceProvider::class);
    }
}
