<?php

namespace LaravelEnso\CnpValidator;

class Validations
{
    public static function validatorCnp($attribute, $cnp)
    {
        $cnpValidator = new CnpValidator($cnp);

        return $cnpValidator->isValid();
    }
}
