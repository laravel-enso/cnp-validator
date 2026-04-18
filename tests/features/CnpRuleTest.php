<?php

use Illuminate\Support\Facades\Validator;
use LaravelEnso\CnpValidator\Validators\Cnp;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CnpRuleTest extends TestCase
{
    #[Test]
    public function passes_for_valid_cnp()
    {
        $validator = Validator::make(
            ['cnp' => '1800119010012'],
            ['cnp' => [new Cnp()]]
        );

        $this->assertFalse($validator->fails());
    }

    #[Test]
    public function fails_for_non_numeric_cnp()
    {
        $validator = Validator::make(
            ['cnp' => '18001190100A2'],
            ['cnp' => [new Cnp()]]
        );

        $this->assertTrue($validator->fails());
    }

    #[Test]
    public function fails_for_invalid_length()
    {
        $validator = Validator::make(
            ['cnp' => '180011901001'],
            ['cnp' => [new Cnp()]]
        );

        $this->assertTrue($validator->fails());
    }

    #[Test]
    public function fails_for_invalid_encoded_date()
    {
        $validator = Validator::make(
            ['cnp' => '1800232010016'],
            ['cnp' => [new Cnp()]]
        );

        $this->assertTrue($validator->fails());
    }

    #[Test]
    public function fails_for_invalid_checksum()
    {
        $validator = Validator::make(
            ['cnp' => '1800119010013'],
            ['cnp' => [new Cnp()]]
        );

        $this->assertTrue($validator->fails());
    }

    #[Test]
    public function returns_invalid_message_when_rule_fails()
    {
        $validator = Validator::make(
            ['cnp' => '1800119010013'],
            ['cnp' => [new Cnp()]]
        );

        $this->assertTrue($validator->fails());
        $this->assertSame(['Invalid'], $validator->errors()->get('cnp'));
    }
}
