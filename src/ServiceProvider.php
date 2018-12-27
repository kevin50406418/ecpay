<?php

namespace Kevin50406418\ECPay;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //Publish Config
        $this->publishes([
            __DIR__ . '/Config/ecpay.php' => config_path('ecpay.php'),
        ], 'config');

        //views
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'ecpay');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ECPay::class, function ($app){
            return new ECPay();
        });

        $this->app->alias(ECPay::class, 'ecpay');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ECPay::class, 'ecpay'];
    }
}