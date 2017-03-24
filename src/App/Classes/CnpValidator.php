<?php

namespace LaravelEnso\CnpValidator\App\Classes;

use Carbon\Carbon;

class CnpValidator
{
    private $cnp;
    private $hashTable;
    private $hashResult;
    private $isValid;

    public function __construct($cnp)
    {
        $this->cnp = $cnp;
        $this->hashTable = [2, 7, 9, 1, 4, 6, 3, 5, 8, 2, 7, 9];
        $this->hashresult = 0;
        $this->isValid = false;
        $this->validate();
    }

    public static function validatorCnp($cnp)
    {
        $cnpValidator = new self($cnp);

        return $cnpValidator->isValid();
    }

    public function isValid()
    {
        return $this->isValid;
    }

    private function validate()
    {
        if ($this->failsLengthTest()) {
            return;
        }
        if ($this->failsNumericTest()) {
            return;
        }

        $this->getHashResult();

        if ($this->failsYearTest()) {
            return;
        }

        $this->isValid = intval($this->cnp[12]) === $this->hashResult;
    }

    private function failsLengthTest()
    {
        return strlen($this->cnp) !== 13;
    }

    private function failsNumericTest()
    {
        return $this->cnp != intval($this->cnp);
    }

    private function getHashResult()
    {
        for ($i = 0; $i < 12; $i++) {
            $this->hashResult += intval($this->cnp[$i]) * $this->hashTable[$i];
        }

        $this->hashResult = $this->hashResult % 11;

        if ($this->hashResult === 10) {
            $this->hashResult = 1;
        }
    }

    private function failsYearTest()
    {
        $year = $this->getYear();

        return $year < 1900 || $year > 2050;
    }

    private function getYear()
    {
        $year = ($this->cnp[1] * 10) + $this->cnp[2];

        if (in_array($this->cnp[0], [1, 2])) {
            $year += 1900;
        } elseif (in_array($this->cnp[0], [3, 4])) {
            $year += 1800;
        } elseif (in_array($this->cnp[0], [5, 6])) {
            $year += 2000;
        } elseif (in_array($this->cnp[0], [7, 8, 9])) {
            $year = $this->compute2K($year);
        }

        return $year;
    }

    private function compute2K($year)
    {
        $year += 2000;

        return $year > ((Carbon::now()->year) - 14) ? $year -= 100 : $year;
    }
}
