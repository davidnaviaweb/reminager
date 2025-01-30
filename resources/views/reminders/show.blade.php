<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reminder details') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-reminders.list-item :reminder="$reminder" :labels="$labels"/>
            <div class="flex justify-end">
                <a href="{{route('dashboard')}}" wire:navigate
                   class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
                    {{__('Go back')}}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
