<?php

namespace LaravelEnso\CnpValidator\app\Classes;

class Validations
{
    public static function validatorCnp($attribute, $cnp)
    {
        return (new CnpValidator($cnp))->isValid();
    }
}
