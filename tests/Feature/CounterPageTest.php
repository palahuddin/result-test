<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CounterPageTest extends TestCase
{
    use RefreshDatabase;

    public function testFromScratch(): void
    {
        $this->runTestAndAssert(1, 1);
    }

    public function testFromScratchMultipleTimesWithinADay(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $this->runTestAndAssert($i, $i);
        }
    }

    public function testMultipleDays(): void
    {
        Carbon::setTestNow(Carbon::create(2021, 3, 1)->startOfDay());
        for ($i = 1; $i <= 5; $i++) {
            $this->runTestAndAssert($i, $i);
        }
        $i--;
        Carbon::setTestNow(Carbon::create(2021, 3, 2)->startOfDay());
        for ($j = 1; $j <= 3; $j++) {
            $this->runTestAndAssert($j + $i, $j);
        }
    }

    private function runTestAndAssert(int $today, int $totalToday): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSeeText($today);
        $response->assertSeeText(sprintf('Today: %s', $totalToday));
    }
}
