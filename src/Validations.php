<?php

namespace LaravelEnso\CnpValidator;

class Validations
{
    public static function validatorCnp($attributeName, $cnp)
    {
        $cnpValidator = new CnpValidator($cnp);

        return $cnpValidator->isValid();
    }
}
