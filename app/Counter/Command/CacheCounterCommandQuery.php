<?php

namespace App\Counter\Command;

use App\Counter\Query\CounterQueryInterface;
use Carbon\Carbon;
use Illuminate\Contracts\Cache\Repository;

class CacheCounterCommandQuery implements CounterCommandInterface, CounterQueryInterface
{
    public function __construct(private Repository $cache)
    {
    }

    public function counter(): void
    {
        $this->incrementCounterTotal()
             ->incrementCounterToday()
        ;
    }

    public function getTotal(): int
    {
        return $this->getFromCache($this->getCacheKey());
    }

    public function getToday(): int
    {
        return $this->getFromCache($this->getTodayCacheKey());
    }

    private function incrementCounterTotal(): static
    {
        return $this->incrementCache($this->getCacheKey());
    }

    private function incrementCounterToday(): static
    {
        $this->incrementCache($this->getTodayCacheKey());

        return $this;
    }

    private function getCacheKey(?Carbon $date = null): string
    {
        return sprintf('%s%s', 'counter', $date ? sprintf(':%s', $date->toDateString()) : '');
    }

    private function getTodayCacheKey(): string
    {
        return $this->getCacheKey(Carbon::now());
    }

    private function incrementCache(string $key): static
    {
        $this->cache->increment($key);

        return $this;
    }

    private function getFromCache(string $key): int
    {
        return intval($this->cache->get($key, 0));
    }
}
