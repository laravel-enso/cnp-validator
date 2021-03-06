<?php

namespace LaravelEnso\CnpValidator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Validator::extend('cnp', 'LaravelEnso\CnpValidator\Validators\Validator@cnp');
    }
}
