<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class OptionServiceProvider extends ServiceProvider
{
    public function boot() {}

    public function register()
    {
        $this->app->bind('OptionServiceProvider', \App\Services\OptionService::class);
    }
}
