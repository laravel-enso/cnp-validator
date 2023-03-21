<?php

namespace LaravelEnso\CnpValidator\Validators;

use Illuminate\Contracts\Validation\InvokableRule;

class Cnp implements InvokableRule
{
    public function __invoke($attribute, $value, $fail)
    {
        if (Validator::fails($value)) {
            $fail(__('Invalid'));
        }
    }
}
