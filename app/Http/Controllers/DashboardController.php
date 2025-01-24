<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reminder;

class DashboardController extends Controller
{
    public function index()
    {
        $reminders = Reminder::where('user_id', auth()->id())
            ->with('labels')
            ->get()
            ->map(function ($reminder) {
                return [
                    'title' => $reminder->name,
                    'description' => $reminder->description,
                    'type' => $reminder->type,
                    'priority' => $reminder->priority,
                    'status' => $reminder->status,
                    'start' => \Carbon\Carbon::parse($reminder->due_date)->toIso8601String(), // Formato ISO
                    'end' => $reminder->end_date ? \Carbon\Carbon::parse($reminder->end_date)->toIso8601String() : null,
                    'labels' => $reminder->labels->pluck('name')->toArray(),
                ];
            });

        return view('dashboard', ['events' => $reminders]);
    }


}

