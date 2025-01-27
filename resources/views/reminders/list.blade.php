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
                No reminders found. Click "Create New Reminder" to add one!
            @endforelse
        </div>
    </div>
</x-app-layout>
