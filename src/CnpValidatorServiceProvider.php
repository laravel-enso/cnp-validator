<?php

namespace LaravelEnso\CnpValidator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class CnpValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('nin', 'LaravelEnso\CnpValidator\app\Classes\Validations@validatorCnp');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
