<?php

namespace App\Http\Controllers;

use App\Enums\ReminderType;
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
                if ($reminder->type === ReminderType::TASK->value) {
                    $start = \Carbon\Carbon::parse($reminder->due_date)->toIso8601String();
                    $end = $start;
                    $isOverdue = isset($reminder->due_date) &&
                        \Carbon\Carbon::parse($reminder->due_date)->isPast() &&
                        $reminder->status != \App\Enums\ReminderStatus::COMPLETED->value;
                } else {
                    $start = \Carbon\Carbon::parse($reminder->start_date)->toIso8601String();
                    $end = \Carbon\Carbon::parse($reminder->end_date)->toIso8601String();
                    $isOverdue = isset($reminder->end_date) &&
                        \Carbon\Carbon::parse($reminder->end_date)->isPast() &&
                        $reminder->status != \App\Enums\ReminderStatus::COMPLETED->value;
                }

                $time = \Carbon\Carbon::parse($reminder->due_date)->format('H:i');

                return [
                    'id' => $reminder->id,
                    'title' => $reminder->title,
                    'start' => $start,
                    'end' => $end,
                    'time' => $time,
                    'isOverdue' => $isOverdue,
                    'priority' => $reminder->priority,
                    'html' => view('components.reminders.calendar-event', compact('reminder', 'time'))->render()
                ];
            });

        $labels = Label::all();
        Log::info($reminders);

        return view('dashboard', ['events' => $reminders], compact('reminders', 'labels'));
    }
}

