<?php

use Tests\TestCase;

class CnpValidatorTest extends TestCase
{
    /** @test */
    public function good_cnp_validates()
    {
        $goodCnp = '1800119081824';

        $goodResult = \Validator::make(['cnp' => $goodCnp], ['cnp' => 'cnp']);

        $this->assertFalse($goodResult->fails());
    }

    /** @test */
    public function bad_cnp_fails_validation()
    {
        $badCnp = '1800191081823';

        $badResult = \Validator::make(['cnp' => $badCnp], ['cnp' => 'cnp']);

        $this->assertTrue($badResult->fails());
    }
}
