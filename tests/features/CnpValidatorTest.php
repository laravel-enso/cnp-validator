<?php

use Tests\TestCase;

class CnpValidatorTest extends TestCase
{
    /** @test */
    public function validates_on_good_cnp()
    {
        $goodCnp = '1800119081824';

        $goodResult = \Validator::make(
            ['cnp' => $goodCnp],
            ['cnp' => 'cnp']
        );

        $this->assertFalse($goodResult->fails());
    }

    /** @test */
    public function fails_validation_on_bad_cnp()
    {
        $badCnp = '1800191081823';

        $badResult = \Validator::make(
            ['cnp' => $badCnp],
            ['cnp' => 'cnp']
        );

        $this->assertTrue($badResult->fails());
    }
}
