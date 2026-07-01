<?php

namespace LaravelEnso\CnpValidator\Validators;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Cnp implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Validator::fails($value)) {
            $fail(__('Invalid'));
        }
    }
}
