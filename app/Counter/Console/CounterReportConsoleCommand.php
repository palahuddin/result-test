<?php

namespace App\Counter\Console;

use App\Counter\CounterReportMail;
use App\Counter\Query\CounterQueryInterface;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Contracts\Mail\Mailer;

class CounterReportConsoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'counter:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reporting to email';

    public function handle(CounterQueryInterface $query, Mailer $mailer)
    {
        $mailer->send(new CounterReportMail(Carbon::now()->startOfDay(), $query->getTotal(), $query->getToday()));
    }
}
