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
                        :submit-label="__('Create')"
                        :labels="$labels"
                    />
                </div>
            </div>

            <!-- Filtro por etiqueta, tipo, prioridad y estado -->
            <div class="mb-6">
                <form method="GET" action="{{ route('reminders.index') }}" class="flex items-stretch space-x-4">
                    <div class="flex flex-col">
                        <label for="label_filter" class="text-gray-700 dark:text-gray-200">Label:</label>
                        <select name="label" id="label_filter" class="px-4 py-2 border rounded-md focus:ring focus:ring-blue-500">
                            <option value="">All</option>
                            @foreach($labels as $label)
                                <option value="{{ $label->name }}" {{ request('label') == $label->name ? 'selected' : '' }}>
                                    {{ $label->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="type_filter" class="text-gray-700 dark:text-gray-200">Type:</label>
                        <select name="type" id="type_filter" class="px-4 py-2 border rounded-md focus:ring focus:ring-blue-500 min-w-40">
                            <option value="">All</option>
                            <option value="task" {{ request('type') == 'task' ? 'selected' : '' }}>Task</option>
                            <option value="event" {{ request('type') == 'event' ? 'selected' : '' }}>Event</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="priority_filter" class="text-gray-700 dark:text-gray-200">Priority:</label>
                        <select name="priority" id="priority_filter" class="px-4 py-2 border rounded-md focus:ring focus:ring-blue-500 min-w-40">
                            <option value="">All</option>
                            <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="status_filter" class="text-gray-700 dark:text-gray-200">Status:</label>
                        <select name="status" id="status_filter" class="px-4 py-2 border rounded-md focus:ring focus:ring-blue-500 min-w-40">
                            <option value="">All</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in-progress" {{ request('status') == 'in-progress' ? 'selected' : '' }}>In progress</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="flex justify-end items-end w-full">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 mr-4 rounded-md">
                            Filter
                        </button>
                        <a href="{{ route('reminders.index') }}" class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded-md">
                            Reset
                        </a>
                    </div>
                </form>
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
