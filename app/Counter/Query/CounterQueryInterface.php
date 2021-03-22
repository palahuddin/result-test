<?php

namespace App\Counter\Query;

interface CounterQueryInterface
{
    public function getTotal(): int;

    public function getToday(): int;
}
