<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'priority',
        'status',
        'due_date',
        'start_date',
        'end_date',
        'user_id',
    ];

    public function labels()
    {
        return $this->belongsToMany(Label::class, 'label_reminder');
    }
}
