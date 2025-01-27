<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Reminder;
use Log;

class DashboardController extends Controller
{
    public function index()
    {
        $reminders = Reminder::where('user_id', auth()->id())
            ->with('labels')
            ->orderBy('due_date')
            ->get()
            ->map(function ($reminder) {
                return [
                    'id' => $reminder->id,
                    'title' => $reminder->name,
                    'description' => $reminder->description,
                    'type' => $reminder->type,
                    'priority' => $reminder->priority,
                    'status' => $reminder->status,
                    'start' => \Carbon\Carbon::parse($reminder->due_date)->toIso8601String(),
                    'time' => \Carbon\Carbon::parse($reminder->due_date)->format('H:i'),
                    'end' => $reminder->end_date ? \Carbon\Carbon::parse($reminder->end_date)->toIso8601String() : null,
                    'labels' => $reminder->labels->toArray(),
                ];
            });

        $labels = Label::all();
        Log::info($reminders);

        return view('dashboard', ['events' => $reminders], compact('reminders', 'labels'));
    }
}

