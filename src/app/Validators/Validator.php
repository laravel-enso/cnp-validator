<?php

namespace LaravelEnso\CnpValidator\app\Validators;

class Validator
{
    public static function cnp($attribute, $cnp)
    {
        return (new CnpValidator($cnp))->passes();
    }
}
