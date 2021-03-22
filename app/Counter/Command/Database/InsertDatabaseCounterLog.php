<?php

namespace App\Counter\Command\Database;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InsertDatabaseCounterLog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private string $userAgent, private string $ipAddress, private int $createdAt)
    {
    }

    public function handle()
    {
        $counterLog = CounterLogModel::create($this->userAgent, $this->ipAddress, $this->createdAt);
        $counterLog->save();
    }
}
