<?php

namespace Tests\Feature;

use App\Counter\CounterReportMail;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CounterReportConsoleTest extends TestCase
{
    use RefreshDatabase;

    public function testSendEmail(): void
    {
        Mail::fake();
        $now = Carbon::create(2021, 3, 1)->startOfDay();
        Carbon::setTestNow($now);

        $this->artisan('counter:report')
             ->assertExitCode(0)
        ;

        Mail::assertQueued(
            function (CounterReportMail $mail) use ($now) {
                return $mail->getDate()->eq($now) && 0 === $mail->getTotal() && 0 === $mail->getTodayTotal();
            }
        );
    }
}
