<?php

namespace LaravelEnso\CnpValidator\Validators;

class Validator
{
    private const HashTable = [2, 7, 9, 1, 4, 6, 3, 5, 8, 2, 7, 9];

    public function __construct(private ?string $cnp = null)
    {
    }

    public static function fails(string $cnp): bool
    {
        return !(new self($cnp))->passes();
    }

    public function passes(): bool
    {
        return $this->isNumeric() && $this->validLength()
            && $this->validDate() && $this->validHash();
    }

    private function isNumeric(): bool
    {
        return $this->cnp === (string) (int) $this->cnp;
    }

    private function validLength(): bool
    {
        return mb_strlen($this->cnp) === 13;
    }

    private function validDate(): bool
    {
        $month = (int) "{$this->cnp[3]}{$this->cnp[4]}";
        $day = (int) "{$this->cnp[5]}{$this->cnp[6]}";
        $year = $this->year();

        return 1900 <= $year && $year <= 2050 && checkdate($month, $day, $year);
    }

    private function validHash(): bool
    {
        return (int) $this->cnp[12] === $this->hash();
    }

    private function year(): int
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

    private function y2k($year): int
    {
        $year += 2000;

        return $year > ((int) date('Y') - 14) ? $year - 100 : $year;
    }

    private function hash(): int
    {
        $hash = array_reduce(
            array_keys(self::HashTable),
            fn ($hash, $key) => $hash += (int) $this->cnp[$key] * self::HashTable[$key]
        ) % 11;

        return $hash === 10 ? 1 : $hash;
    }
}
