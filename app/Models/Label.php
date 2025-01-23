<?php
// app/Models/Label.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'backgroundColor',
        'textClass'
    ];

    public function reminders()
    {
        return $this->belongsToMany(Reminder::class, 'label_reminder');
    }
}
