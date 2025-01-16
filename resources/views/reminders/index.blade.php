<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reminders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Botón para crear un nuevo recordatorio -->
            <div x-data="{ showForm: false }" class="mb-6 flex flex-col">
                <!-- Botón para abrir el formulario -->
                <div class="flex justify-end">
                    <button @click="showForm = true"
                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg text-xl shadow-lg flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        {{ __('New Reminder') }}
                    </button>
                </div>

                <!-- Panel desplegable con el formulario -->
                <div x-show="showForm" x-transition class="mt-4 p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Create New Reminder</h2>

                    <!-- Include Componente del formulario -->
                    <x-reminder-form
                        :action="route('reminders.store')"
                        :on-submit="'showForm = false'"
                        :on-cancel="'showForm = false'"
                        :submit-label="'Create'"
                    />
                </div>
            </div>


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
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-800 dark:text-gray-200">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($reminders as $reminder)
                        <tr class="border-t border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                            <td class="px-6 py-4 text-gray-800 dark:text-gray-200 font-semibold">
                                {{ $reminder->name }}
                            </td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                {{ \Illuminate\Support\Str::limit($reminder->description, 50, '...') }}
                            </td>
                            <td class="px-6 py-4 text-gray-800 dark:text-gray-200">
                                {{ $reminder->type }}
                            </td>
                            <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded text-white"
                                          style="background-color: {{ $reminder->priority === 'High' ? '#ff4d4d' : ($reminder->priority === 'Medium' ? '#ffcc00' : '#5cb85c') }}">
                                        {{ $reminder->priority }}
                                    </span>
                            </td>
                            <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded text-white"
                                          style="background-color: {{ $reminder->status === 'Completed' ? '#28a745' : ($reminder->status === 'In progress' ? '#ffc107' : '#dc3545') }}">
                                        {{ $reminder->status }}
                                    </span>
                            </td>
                            <td class="px-6 py-4 text-gray-800 dark:text-gray-200">
                                {{ \Carbon\Carbon::parse($reminder->due_date)->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <!-- Botón de View -->
                                    <a href="{{ route('reminders.show', $reminder->id) }}"
                                       class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded text-sm flex items-center shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm-1 11a1 1 0 112 0 1 1 0 01-2 0zm1-2a1 1 0 01-1-1V7a1 1 0 112 0v3a1 1 0 01-1 1z" />
                                        </svg>
                                        View
                                    </a>

                                    <!-- Botón de Edit -->
                                    <a href="{{ route('reminders.edit', $reminder->id) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded text-sm flex items-center shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 010 2.828l-9.9 9.9a2 2 0 01-.708.466l-4.267 1.422a1 1 0 01-1.265-1.265l1.422-4.267a2 2 0 01.466-.708l9.9-9.9a2 2 0 012.828 0zm-2.828 1.414L6.586 12H9v2.414l7.586-7.586-2.828-2.828z" />
                                        </svg>
                                        Edit
                                    </a>

                                    <!-- Botón de Delete -->
                                    <form action="{{ route('reminders.destroy', $reminder->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded text-sm flex items-center shadow">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm4.293-9.707a1 1 0 00-1.414-1.414L10 10.586 7.121 7.707a1 1 0 00-1.414 1.414l2.879 2.879a1 1 0 001.414 0l4.293-4.293z" clip-rule="evenodd" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
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
