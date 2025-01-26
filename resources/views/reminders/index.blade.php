<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reminders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Componente para crear un nuevo recordatorio -->
            <x-reminder-list-new-element :labels="$labels"/>

            <!-- Include the reminder filters component -->
            @if($reminders->isNotEmpty())
                <x-reminder-list-filters :labels="$labels"/>
            @endif

            <!-- Contenedor de la lista -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-800 dark:text-gray-200">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-800 dark:text-gray-200">Description</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-800 dark:text-gray-200">Type</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-800 dark:text-gray-200">Priority</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-800 dark:text-gray-200">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-800 dark:text-gray-200">Due Date</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-800 dark:text-gray-200">Labels</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-800 dark:text-gray-200">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($reminders as $reminder)
                        <x-reminder-inline-edit :reminder="$reminder" :labels="$labels" />
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-600 dark:text-gray-400">
                                No reminders found. Click "Create New Reminder" to add one!
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
