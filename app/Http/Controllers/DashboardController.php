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
                $start = \Carbon\Carbon::parse($reminder->due_date)->toIso8601String();
                $end = $reminder->end_date ? \Carbon\Carbon::parse($reminder->end_date)->toIso8601String() : null;
                $time = \Carbon\Carbon::parse($reminder->due_date)->format('H:i');
                return [
                    'id' => $reminder->id,
                    'title' => $reminder->name,
                    'start' => $start,
                    'end' => $end,
                    'time' => $time,
                    'priority' => $reminder->priority,
                    'html' => view('components.reminders.calendar-event', compact('reminder', 'time'))->render()
                ];
            });

        $labels = Label::all();
        Log::info($reminders);

        return view('dashboard', ['events' => $reminders], compact('reminders', 'labels'));
    }
}

