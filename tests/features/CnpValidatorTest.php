<?php

use Illuminate\Support\Facades\Validator;
use LaravelEnso\CnpValidator\Validators\Cnp;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CnpValidatorTest extends TestCase
{
    #[Test]
    public function passes_on_good_cnp()
    {
        $validator = Validator::make(
            ['cnp' => '1800119081824'],
            ['cnp' => new Cnp()]
        );

        $this->assertFalse($validator->fails());
    }

    #[Test]
    public function fails_on_bad_cnp()
    {
        $validator = Validator::make(
            ['cnp' => '1800191081823'],
            ['cnp' => new Cnp()]
        );

        $this->assertTrue($validator->fails());
    }
}
