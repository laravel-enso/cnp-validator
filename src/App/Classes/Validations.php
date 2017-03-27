<?php

namespace LaravelEnso\CnpValidator\app\Classes;

class Validations
{
    public static function validatorCnp($attribute, $cnp)
    {
        $cnpValidator = new CnpValidator($cnp);

        return $cnpValidator->isValid();
    }
}
