<?php

namespace App\Counter;

use App\Counter\Command\CacheCounterCommandQuery;
use App\Counter\Query\CounterQueryInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CounterServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->singleton(CounterQueryInterface::class, CacheCounterCommandQuery::class);
    }

    public function provides()
    {
        return [
            CounterQueryInterface::class,
        ];
    }
}
