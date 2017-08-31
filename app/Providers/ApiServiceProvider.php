<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //TODO 注册数据返回格式
        $this->app->bind(\App\Services\Api\ApiService::class, \App\Services\Api\ApiServiceClass::class);
    }
}
