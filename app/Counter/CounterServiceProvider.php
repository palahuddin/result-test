<?php

namespace App\Counter;

use App\Counter\Command\CacheCounterCommandQuery;
use App\Counter\Command\CompositeCounterCommand;
use App\Counter\Command\CounterCommandInterface;
use App\Counter\Command\DatabaseCounterLogCommand;
use App\Counter\Query\CounterQueryInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CounterServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->singleton(CounterQueryInterface::class, CacheCounterCommandQuery::class);
        $this->app->singleton(
            CounterCommandInterface::class,
            fn() => new CompositeCounterCommand(
                [
                    $this->app->make(CacheCounterCommandQuery::class),
                    $this->app->make(DatabaseCounterLogCommand::class),
                ]
            )
        );
    }

    public function provides()
    {
        return [
            CounterQueryInterface::class,
            CounterCommandInterface::class,
        ];
    }
}
