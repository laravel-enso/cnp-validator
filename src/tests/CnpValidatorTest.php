<?php

use Tests\TestCase;

class CnpValidatorTest extends TestCase
{
    /** @test */
    public function validate_cnp()
    {
        // Arrange
        $goodCnp = '1800119081824';
        $badCnp = '1800191081823';

        // Act
        $goodResult = \Validator::make(['cnp' => $goodCnp], ['cnp' => 'cnp']);
        $badResult = \Validator::make(['cnp' => $badCnp], ['cnp' => 'cnp']);

        // Assert
        $this->assertTrue(!$goodResult->fails());
        $this->assertTrue($badResult->fails());
    }
}
