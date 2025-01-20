<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reminder Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenedor principal -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <!-- Título -->
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                        {{ $reminder->name }}
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Created on: {{ $reminder->created_at->format('M d, Y H:i') }}
                    </p>
                </div>

                <!-- Descripción -->
                <div class="mb-6">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Description</h4>
                    <p class="text-gray-700 dark:text-gray-300">
                        {{ $reminder->description ?? 'No description provided.' }}
                    </p>
                </div>

                <!-- Detalles -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Type</h4>
                        <p class="text-gray-700 dark:text-gray-300">{{ $reminder->type }}</p>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Priority</h4>
                        <p class="px-2 py-1 inline-block rounded text-white"
                           style="background-color: {{ $reminder->priority === 'High' ? '#ff4d4d' : ($reminder->priority === 'Medium' ? '#ffcc00' : '#5cb85c') }}">
                            {{ $reminder->priority }}
                        </p>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Status</h4>
                        <p class="px-2 py-1 inline-block rounded text-white"
                           style="background-color: {{ $reminder->status === 'Completed' ? '#28a745' : ($reminder->status === 'In progress' ? '#ffc107' : '#dc3545') }}">
                            {{ $reminder->status }}
                        </p>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Due Date</h4>
                        <p class="text-gray-700 dark:text-gray-300">
                            {{ \Carbon\Carbon::parse($reminder->due_date)->format('M d, Y H:i') }}
                        </p>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Label</h4>
                        <p class="px-2 py-1 inline-block rounded bg-blue-100 text-blue-800">
                            {{ $reminder->label ?? 'No label' }}
                        </p>
                    </div>
                </div>

                <!-- Acciones rápidas -->
                <div class="flex space-x-4 mt-6">
                    <form action="{{ route('reminders.destroy', $reminder->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"
                                onclick="return confirm('Are you sure you want to delete this reminder?')">
                            Delete
                        </button>
                    </form>
                    <a href="{{ route('reminders.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
