<?php

namespace LaravelEnso\CnpValidator\app\Validators;

use Carbon\Carbon;

class Validator
{
    private const HasTable = [2, 7, 9, 1, 4, 6, 3, 5, 8, 2, 7, 9];

    private $cnp;
    private $hashResult = 0;
    private $isValid = false;

    public function __construct($cnp)
    {
        $this->cnp = $cnp;
    }

    public static function cnp($cnp)
    {
        return (new self($cnp))
            ->passes();
    }

    public function passes()
    {
        $this->validate();

        return $this->isValid;
    }

    private function validate()
    {
        if ($this->failsLengthTest() || $this->failsNumericTest()) {
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
            $this->hashResult += intval($this->cnp[$i]) * self::HasTable[$i];
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
            return $year + 1900;
        }

        if (in_array($this->cnp[0], [3, 4])) {
            return $year + 1800;
        }

        return in_array($this->cnp[0], [5, 6])
            ? $year + 2000
            : $this->compute2K($year);
    }

    private function compute2K($year)
    {
        $year += 2000;

        return $year > ((Carbon::now()->year) - 14) ? $year -= 100 : $year;
    }
}
