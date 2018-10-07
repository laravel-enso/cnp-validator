<?php

namespace LaravelEnso\CnpValidator;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\CnpValidator\app\Classes\CnpValidator;

class CnpValidatorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \Validator::extend('cnp', function ($attribute, $value) {
            return (new CnpValidator($value))
                ->passes();
        });
    }

    public function register()
    {
        //
    }
}
