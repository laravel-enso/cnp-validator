<?php

namespace LaravelEnso\CnpValidator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use LaravelEnso\CnpValidator\Validators\Validator as CnpValidator;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Validator::extend(
            'cnp',
            static fn (string $attribute, mixed $value): bool => is_scalar($value)
                && ! (new CnpValidator((string) $value))->fails(),
            'The :attribute must be a valid CNP.',
        );
    }
}
