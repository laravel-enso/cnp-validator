<?php

namespace LaravelEnso\CnpValidator\App\Classes;

class Validations
{
    public static function validatorCnp($attribute, $cnp)
    {
        $cnpValidator = new CnpValidator($cnp);

        return $cnpValidator->isValid();
    }
}
