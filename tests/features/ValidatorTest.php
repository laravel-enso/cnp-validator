<?php

use LaravelEnso\CnpValidator\Validators\Validator;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ValidatorTest extends TestCase
{
    #[Test]
    public function passes_for_valid_1900_series_cnp()
    {
        $this->assertTrue((new Validator('1800119010012'))->passes());
        $this->assertTrue((new Validator('2800119010014'))->passes());
    }

    #[Test]
    public function fails_for_1800_series_cnp_because_validator_limits_years_to_1900_and_2050()
    {
        $this->assertFalse((new Validator('3800119010016'))->passes());
        $this->assertFalse((new Validator('4800119010018'))->passes());
    }

    #[Test]
    public function passes_for_valid_2000_series_cnp()
    {
        $this->assertTrue((new Validator('5100615010012'))->passes());
        $this->assertTrue((new Validator('6100615010014'))->passes());
    }

    #[Test]
    public function handles_y2k_series_consistently()
    {
        $this->assertTrue((new Validator('7030520010012'))->passes());
        $this->assertTrue((new Validator('8030520010014'))->passes());
    }

    #[Test]
    public function static_fails_matches_instance_passes()
    {
        $valid = '1800119010012';
        $invalid = '1800119010013';

        $this->assertFalse(Validator::fails($valid));
        $this->assertTrue((new Validator($valid))->passes());

        $this->assertTrue(Validator::fails($invalid));
        $this->assertFalse((new Validator($invalid))->passes());
    }
}
