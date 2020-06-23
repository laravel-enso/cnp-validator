<?php

use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class CnpValidatorTest extends TestCase
{
    /** @test */
    public function passes_on_good_cnp()
    {
        $validator = Validator::make(
            ['cnp' => '1800119081824'],
            ['cnp' => 'cnp']
        );

        $this->assertFalse($validator->fails());
    }

    /** @test */
    public function fails_on_bad_cnp()
    {
        $validator = Validator::make(
            ['cnp' => '1800191081823'],
            ['cnp' => 'cnp']
        );

        $this->assertTrue($validator->fails());
    }
}
