<?php

use Illuminate\Support\Facades\Validator;
use LaravelEnso\CnpValidator\AppServiceProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CnpStringRuleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        (new AppServiceProvider($this->app))->boot();
    }

    #[Test]
    public function passes_for_valid_cnp()
    {
        $validator = Validator::make(
            ['cnp' => '1800119010012'],
            ['cnp' => ['cnp']]
        );

        $this->assertFalse($validator->fails());
    }

    #[Test]
    public function fails_for_invalid_cnp()
    {
        $validator = Validator::make(
            ['cnp' => '1800119010013'],
            ['cnp' => ['cnp']]
        );

        $this->assertTrue($validator->fails());
        $this->assertSame(
            ['The cnp must be a valid CNP.'],
            $validator->errors()->get('cnp')
        );
    }
}
