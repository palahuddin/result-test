<?php

namespace App\Counter\Command;

use App\Counter\Command\Database\InsertDatabaseCounterLog;
use Carbon\Carbon;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\Request;

class DatabaseCounterLogCommand implements CounterCommandInterface
{
    public function __construct(private Request $request, private Dispatcher $dispatcher)
    {
    }

    public function counter(): void
    {
        $userAgent = $this->request->userAgent();
        $ipAddress = $this->request->ip();
        $createdAt = Carbon::now()->timestamp;

        $this->dispatcher->dispatch(new InsertDatabaseCounterLog($userAgent, $ipAddress, $createdAt));
    }
}
