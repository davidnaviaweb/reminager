<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reminder Details') }}
        </h2>
    </x-slot>
    <x-reminder-list-element :reminder="$reminder"/>
</x-app-layout>
