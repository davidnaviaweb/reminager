<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'priority',
        'status',
        'due_date',
        'user_id',
    ];
}
