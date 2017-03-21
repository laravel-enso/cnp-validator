<?php

namespace LaravelEnso\CnpValidator;

use Jenssegers\Date\Date;

class CnpValidator
{

    private $cnp;
    private $hashTale;
    private $hashResult;
    private $isValid;

    public function __construct($cnp)
    {
        $this->cnp      = $cnp;
        $this->hashTable = [2, 7, 9, 1, 4, 6, 3, 5, 8, 2, 7, 9];
        $this->hashresult = 0;
        $this->validate();
    }

    public static function validatorCnp($attribute, $cnp)
    {
        $cnpValidator = new CnpValidator($cnp);

        return $cnpValidator->isValid();
    }

    public function isValid()
    {
    	return $this->isValid;
    }

    private function validate()
    {
       	if ($this->failsLengthTest()) return false;
       	if ($this->failsNumericTest()) return false;

       	$this->getHashResult();

        if ($this->failsYearTest()) return false;

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

        return $year < 1800 || $year > 2099;
    }

    private function getYear()
    {
    	$year = ($this->cnp[1] * 10) + $this->cnp[2];

        switch ($this->cnp[0]) {

            case 1:
            case 2: $year += 1900; break;

            case 3: case 4: $year += 1800; break;

            case 5:
            case 6: $year += 2000; break;

            case 7:
            case 8:
            case 9: {
                $year += 2000;

                if ($year > ((Date::now()->year) - 14)) {
                    $year -= 100;
                }
            }
            break;
        }

        return $year;
    }
}
