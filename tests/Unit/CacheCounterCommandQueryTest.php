<?php

namespace Tests\Unit;

use App\Counter\Command\CacheCounterCommandQuery;
use Carbon\Carbon;
use Tests\TestCase;

class CacheCounterCommandQueryTest extends TestCase
{
    private CacheCounterCommandQuery $counter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->counter = app(CacheCounterCommandQuery::class);
    }

    public function testDefaultGetIsZero(): void
    {
        $this->assertSame(0, $this->counter->getTotal());
        $this->assertSame(0, $this->counter->getToday());
    }

    public function testCounterAddTotalAndToday(): void
    {
        $this->testDefaultGetIsZero();

        $this->counter->counter();

        $this->assertSame(1, $this->counter->getTotal());
        $this->assertSame(1, $this->counter->getToday());

        $this->counter->counter();

        $this->assertSame(2, $this->counter->getTotal());
        $this->assertSame(2, $this->counter->getToday());
    }

    public function testCounterMultipleDays(): void
    {
        $this->testDefaultGetIsZero();

        Carbon::setTestNow(Carbon::create(2021, 3, 1)->startOfDay());

        $this->counter->counter();

        $this->assertSame(1, $this->counter->getTotal());
        $this->assertSame(1, $this->counter->getToday());

        $this->counter->counter();

        $this->assertSame(2, $this->counter->getTotal());
        $this->assertSame(2, $this->counter->getToday());

        Carbon::setTestNow(Carbon::create(2021, 3, 2)->startOfDay());

        $this->assertSame(2, $this->counter->getTotal());
        $this->assertSame(0, $this->counter->getToday());

        $this->counter->counter();

        $this->assertSame(3, $this->counter->getTotal());
        $this->assertSame(1, $this->counter->getToday());

        $this->counter->counter();

        $this->assertSame(4, $this->counter->getTotal());
        $this->assertSame(2, $this->counter->getToday());
    }
}
