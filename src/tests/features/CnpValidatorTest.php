<?php

use Tests\TestCase;

class CnpValidatorTest extends TestCase
{
    /** @test */
    public function validate()
    {
        $goodCnp = '1800119081824';
        $badCnp = '1800191081823';

        $goodResult = \Validator::make(['cnp' => $goodCnp], ['cnp' => 'cnp']);
        $badResult = \Validator::make(['cnp' => $badCnp], ['cnp' => 'cnp']);

        $this->assertFalse($goodResult->fails());
        $this->assertTrue($badResult->fails());
    }
}
