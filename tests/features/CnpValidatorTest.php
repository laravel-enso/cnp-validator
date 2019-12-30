<?php

use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class CnpValidatorTest extends TestCase
{
    /** @test */
    public function passes_on_good_cnp()
    {
        $cnp = '1800119081824';

        $validator = Validator::make(
            ['cnp' => $cnp],
            ['cnp' => 'cnp']
        );

        $this->assertFalse($validator->fails());
    }

    /** @test */
    public function fails_on_bad_cnp()
    {
        $cnp = '1800191081823';

        $validator = Validator::make(
            ['cnp' => $cnp],
            ['cnp' => 'cnp']
        );

        $this->assertTrue($validator->fails());
    }
}
