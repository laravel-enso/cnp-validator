<?php

namespace LaravelEnso\CnpValidator\app\Classes;

class Validator
{
    public static function cnp($attribute, $cnp)
    {
        return (new CnpValidator($cnp))->isValid();
    }
}
