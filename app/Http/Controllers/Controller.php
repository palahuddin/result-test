<?php

namespace App\Http\Controllers;

use App\Counter\Command\CounterCommandInterface;
use App\Counter\Query\CounterQueryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home(CounterCommandInterface $command, CounterQueryInterface $query)
    {
        $command->counter();

        return view(
            'home',
            [
                'total'      => $query->getTotal(),
                'dailyTotal' => $query->getToday(),
            ]
        );
    }
}
