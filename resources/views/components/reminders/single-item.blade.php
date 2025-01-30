<?php

use App\Enums\ReminderType;

$isOverdue = isset($reminder->due_date) &&
    \Carbon\Carbon::parse($reminder->due_date)->isPast() &&
    $reminder->status != \App\Enums\ReminderStatus::COMPLETED->value;
?>

<div x-data="{ isEditing: false }">
    <div class="flex flex-col items-start sm:flex-row gap-8 mb-10 sm:mb-20">
        <div class="w-full lg:w-1/2">
            <h3 class="flex items-center text-3xl font-semibold text-gray-900 dark:text-gray-100 gap-2 mb-4 truncate">
                <x-reminders.type-badge :type="$reminder->type"/>
                {{ $reminder->title }}
                @if($isOverdue)
                    <span
                        class="text-sm w-20 text-center font-semibold bg-red-700 text-red-100 dark:bg-red-100 dark:text-red-700 px-2 py-1 ml-2 rounded-full">
                        {{__('Overdue')}}
                    </span>
                @endif
            </h3>
           <x-reminders.single-item-dates :reminder="$reminder"/>
            <p class="text-gray-700 dark:text-gray-300 mt-8 italic">
                {{ $reminder->description ?? 'No description provided.' }}
            </p>
        </div>
        <div
            class="flex sm:flex-col md:flex-row w-full  lg:w-1/2 gap-4 border-t sm:border-t-0 sm:border-l sm:pl-4 md:border-none md:pl-0 pt-6 sm:pt-0">
            <div class="flex flex-col sm:flex-row md:flex-col w-full md:w-1/4 items-center justify-start gap-2">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{__('Priority')}}</h4>
                <x-reminders.priority-badge :priority="$reminder->priority"/>
            </div>
            <div class="flex flex-col sm:flex-row md:flex-col w-full md:w-1/4 items-center justify-start gap-2">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{__('Status')}}</h4>
                <x-reminders.status-badge :status="$reminder->status"/>
            </div>
            <div class="flex flex-col sm:flex-row md:flex-col w-full md:w-1/2 items-center justify-start gap-2">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{__('Labels')}}</h4>
                <x-reminders.labels-list :labels="$reminder->labels" :justify="'start'"/>
            </div>
        </div>
    </div>
</div>
