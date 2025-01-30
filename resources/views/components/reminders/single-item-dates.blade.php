<?php

use App\Enums\ReminderType;

$isTaskOverdue = $reminder->type == ReminderType::TASK->value &&
    isset($reminder->due_date) &&
    \Carbon\Carbon::parse($reminder->due_date)->isPast() &&
    $reminder->status != \App\Enums\ReminderStatus::COMPLETED->value;

$isEventOverdue = $reminder->type == ReminderType::EVENT->value &&
    isset($reminder->end_date) &&
    \Carbon\Carbon::parse($reminder->end_date)->isPast() &&
    $reminder->status != \App\Enums\ReminderStatus::COMPLETED->value;
?>
<div class="flex flex-col gap-2 text-gray-600 dark:text-gray-300">
    @if($reminder->type == ReminderType::TASK->value)
        <div
            class="flex items-center sm:items-start sm:flex-col md:flex-row gap-2 {{$isTaskOverdue ? 'text-red-800 dark:text-red-400' : 'text-gray-700 dark:text-gray-300'}}">
            <div class="flex items-center gap-2">
                <x-heroicon-c-calendar-days class="w-6 h-6"/>
                <span class="text-base font-semibold ">
                    {{ \Carbon\Carbon::parse($reminder->due_date)->format('d-m-Y') }}
                </span>
                <x-heroicon-c-clock class="w-6 h-6 ml-2"/>
                <span class="text-base font-semibold">
                    {{ \Carbon\Carbon::parse($reminder->due_date)->format('H:i') }}
                </span>
            </div>
        </div>
    @else
        <div
            class="flex items-center sm:items-start sm:flex-col md:flex-row gap-2 {{$isEventOverdue ? 'text-red-800 dark:text-red-400' : 'text-gray-700 dark:text-gray-300'}}">
            <span class="mr-2">{{__('From')}}:</span>
            <div class="flex gap-2">
                <x-heroicon-c-calendar-days class="w-6 h-6"/>
                <span class="text-base font-semibold">
                {{ \Carbon\Carbon::parse($reminder->start_date)->format('d-m-Y') }}
                </span>
                <x-heroicon-c-clock class="w-6 h-6 ml-4"/>
                <span class="text-base font-semibold">
                {{ \Carbon\Carbon::parse($reminder->start_date)->format('H:i') }}
                </span>
            </div>
        </div>
        <div class="flex items-center sm:items-start sm:flex-col md:flex-row gap-2 {{$isEventOverdue ? 'text-red-800 dark:text-red-400' : 'text-gray-700 dark:text-gray-300'}}">
            <span class="mr-2">{{__('Until')}}:</span>
            <div class="flex gap-2">
                <x-heroicon-c-calendar-days class="w-6 h-6 "/>
                <span class="text-base font-semibold ">
                {{ \Carbon\Carbon::parse($reminder->end_date)->format('d-m-Y') }}
                </span>
                <x-heroicon-c-clock class="w-6 h-6  ml-4"/>
                <span class="text-base font-semibold ">
                {{ \Carbon\Carbon::parse($reminder->end_date)->format('H:i') }}
                </span>
            </div>
        </div>
    @endif
</div>
