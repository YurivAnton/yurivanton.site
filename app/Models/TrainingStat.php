<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingStat extends Model
{
    protected $fillable = [
        'user_id',
        'mistakes',
        'time_seconds',
        'tasks_total',
    ];
}
