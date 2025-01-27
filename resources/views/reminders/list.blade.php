<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reminders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Componente para crear un nuevo recordatorio -->
            <x-reminders.new-item :labels="$labels"/>

            <!-- Include the reminder filters component -->
            @if($reminders->isNotEmpty())
                <x-reminders.list-filters :labels="$labels"/>
            @endif

            @forelse ($reminders as $reminder)
                <x-reminders.list-item :reminder="$reminder" :labels="$labels"/>
            @empty
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
                    <p class="text-gray-700 dark:text-gray-300">
                        No reminders found. Click "Create New Reminder" to add one or reset the filters.
                    </p>
                    <div class="flex justify-end items-end w-full">
                        <a href="{{ route('reminders.index') }}"
                           class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded-md">
                            Reset filters
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
