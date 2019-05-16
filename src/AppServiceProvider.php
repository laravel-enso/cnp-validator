<?php

namespace LaravelEnso\CnpValidator;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \Validator::extend(
            'cnp',
            'LaravelEnso\CnpValidator\app\Validators\Validator@cnp'
        );
    }
}
