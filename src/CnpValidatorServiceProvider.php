<?php

namespace LaravelEnso\CnpValidator;

use Illuminate\Support\ServiceProvider;

class CnpValidatorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \Validator::extend('cnp', 'LaravelEnso\CnpValidator\app\Classes\Validator@cnp');
    }

    public function register()
    {
        //
    }
}
