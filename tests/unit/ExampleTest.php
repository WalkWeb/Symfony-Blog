<?php

namespace App\Tests;

use Codeception\Test\Unit;

class ExampleTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    public function testSomeFeature(): void
    {
        self::assertEquals(1, 1);
    }
}
