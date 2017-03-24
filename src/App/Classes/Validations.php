<?php

namespace LaravelEnso\CnpValidator\App\Classes;

use LaravelEnso\CnpValidator\App\Classes\CnpValidator;

class Validations
{
    public static function validatorCnp($attribute, $cnp)
    {
        $cnpValidator = new CnpValidator($cnp);

        return $cnpValidator->isValid();
    }
}
