<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id', 
        'content', 
        'level', 
        'date', 
        'week',
        'time', 
        'notify_time',
        'notify_date_1', 
        'notify_week_1',
        'notify_date_2',
        'notify_week_2', 
        'notify_date_3', 
        'notify_week_3',
    ];

    protected $guarded = [
    ];
}
