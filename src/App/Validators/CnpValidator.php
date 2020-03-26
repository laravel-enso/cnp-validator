<?php

namespace LaravelEnso\CnpValidator\App\Validators;

class CnpValidator
{
    private const HashTable = [2, 7, 9, 1, 4, 6, 3, 5, 8, 2, 7, 9];

    private $cnp;

    public function __construct($cnp = null)
    {
        $this->cnp = $cnp;
    }

    public function passes()
    {
        return $this->isNumeric() && $this->validLength()
            && $this->validDate() && $this->validHash();
    }

    private function isNumeric()
    {
        return $this->cnp === (string) (int) $this->cnp;
    }

    private function validLength()
    {
        return strlen($this->cnp) === 13;
    }

    private function validDate()
    {
        $month = (int) "{$this->cnp[3]}{$this->cnp[4]}";
        $day = (int) "{$this->cnp[5]}{$this->cnp[6]}";
        $year = $this->year();

        return 1900 <= $year && $year <= 2050 && checkdate($month, $day, $year);
    }

    private function validHash()
    {
        return (int) $this->cnp[12] === $this->hash();
    }

    private function year()
    {
        $year = ((int) $this->cnp[1] * 10) + ((int) $this->cnp[2]);

        if (in_array((int) $this->cnp[0], [1, 2])) {
            return $year + 1900;
        }

        if (in_array((int) $this->cnp[0], [3, 4])) {
            return $year + 1800;
        }

        return in_array((int) $this->cnp[0], [5, 6])
            ? $year + 2000
            : $this->y2K($year);
    }

    private function y2k($year)
    {
        $year += 2000;

        return $year > ((int) date('Y') - 14) ? $year - 100 : $year;
    }

    private function hash()
    {
        $hash = array_reduce(
            array_keys(self::HashTable),
            fn ($hash, $key) => $hash += (int) $this->cnp[$key] * self::HashTable[$key]
        ) % 11;

        return $hash === 10 ? 1 : $hash;
    }
}
