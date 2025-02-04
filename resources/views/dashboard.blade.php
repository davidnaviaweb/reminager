<?php

use App\Enums\ReminderPriority;
use App\Enums\ReminderStatus;
use App\Enums\ReminderType;

?>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All your reminders in one calendar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 h-auto">
                    <div id="preloader">
                        <div class="text-center text-gray-900 dark:text-gray-100">
                            Loading calendar...
                        </div>
                        <div class="rotating-plane bg-gray-800 dark:bg-gray-50 w-28 h-28 mx-auto my-4"></div>
                    </div>
                    <div id="calendar-wrapper" class="h-auto hidden">
                        <div class="flex justify-between items-center md:justify-start">
                            <select name="priority" id="priorityFilter"
                                    class="px-4 py-2 border rounded-md focus:ring focus:ring-blue-500 min-w-40">
                                <option value="">Filter by priority</option>
                                @foreach(ReminderPriority::getValues() as $priority)
                                    <option value="{{ $priority }}"
                                        {{ request('priority') ==  $priority ? 'selected' : '' }}>
                                        {{ ReminderPriority::getConfig( $priority)['label'] }}
                                    </option>
                                @endforeach
                            </select>
                            <select name="label" id="labelFilter"
                                    class="px-4 py-2 border rounded-md focus:ring focus:ring-blue-500 min-w-40 md:ml-4">
                                <option value="">Filter by label</option>
                                @foreach($labels as $label)
                                    <option
                                        value="{{ $label->name }}" {{ request('label') == $label->name ? 'selected' : '' }}>
                                        {{ $label->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div id="calendar" class="text-gray-900 dark:text-gray-100 mt-8 text-sm h-screen"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Define reminders en el navegador -->
    <script>
        window.reminders = @json($events);
    </script>

    <!-- Incluye el archivo compilado con Vite -->
    @vite(['resources/js/app.js'])
</x-app-layout>
