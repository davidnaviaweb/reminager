<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'priority',
        'status',
        'due_date',
        'label',
        'user_id',
    ];
}
