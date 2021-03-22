<?php

namespace App\Counter;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CounterReportMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(private Carbon $date, private int $total, private int $todayTotal)
    {
    }

    public function build(): void
    {
        $this->view(
            'report',
            [
                'date'       => $this->getDate()->toDateString(),
                'total'      => $this->getTotal(),
                'todayTotal' => $this->getTodayTotal(),
            ]
        )
             ->to('report@counter.com')
        ;
    }

    public function getDate(): Carbon
    {
        return $this->date;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getTodayTotal(): int
    {
        return $this->todayTotal;
    }
}
