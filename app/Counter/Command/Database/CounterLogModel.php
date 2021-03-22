<?php

namespace App\Counter\Command\Database;

use Illuminate\Database\Eloquent\Model;

class CounterLogModel extends Model
{
    protected $table = 'counter_log';

    public $timestamps = false;

    public static function create(string $userAgent, string $ipAddress, int $createdAt): static
    {
        $model = new static();
        $model->user_agent = $userAgent;
        $model->ip_address = $ipAddress;
        $model->created_at = $createdAt;

        return $model;
    }
}
