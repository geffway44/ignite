<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Inspectors\SpamInspector;

class SpamTest extends TestCase
{
    /** @test */
    public function it_checks_for_invalid_keywords()
    {
        $spam = new SpamInspector;

        $this->assertFalse($spam->detect('Innocent reply content.'));

        $this->expectException('Exception');

        $this->assertTrue($spam->detect('Yahoo customer support.'));
    }
}
