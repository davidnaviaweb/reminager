<tr x-data="{ isEditing: false }" class="border-t border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
    <!-- Nombre -->
    <td class="px-6 py-4 text-gray-800 dark:text-gray-200 font-semibold">
        <template x-if="!isEditing">
            <span>{{ $reminder->name }}</span>
        </template>
        <template x-if="isEditing">
            <input type="text" name="name" value="{{ $reminder->name }}" class="w-full px-3 py-2 border rounded-md shadow-sm" />
        </template>
    </td>

    <!-- Descripción -->
    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
        <template x-if="!isEditing">
            <span>{{ \Illuminate\Support\Str::limit($reminder->description, 50, '...') }}</span>
        </template>
        <template x-if="isEditing">
            <textarea name="description" class="w-full px-3 py-2 border rounded-md shadow-sm">{{ $reminder->description }}</textarea>
        </template>
    </td>

    <!-- Tipo -->
    <td class="px-6 py-4 text-gray-800 dark:text-gray-200">
        <template x-if="!isEditing">
            <span>{{ $reminder->type }}</span>
        </template>
        <template x-if="isEditing">
            <select name="type" class="w-full px-3 py-2 border rounded-md shadow-sm">
                <option value="Task" {{ $reminder->type === 'Task' ? 'selected' : '' }}>Task</option>
                <option value="Event" {{ $reminder->type === 'Event' ? 'selected' : '' }}>Event</option>
            </select>
        </template>
    </td>

    <!-- Prioridad -->
    <td class="px-6 py-4">
        <template x-if="!isEditing">
            <span class="px-2 py-1 rounded text-white"
                  style="background-color: {{ $reminder->priority === 'High' ? '#ff4d4d' : ($reminder->priority === 'Medium' ? '#ffcc00' : '#5cb85c') }}">
                {{ $reminder->priority }}
            </span>
        </template>
        <template x-if="isEditing">
            <select name="priority" class="w-full px-3 py-2 border rounded-md shadow-sm">
                <option value="High" {{ $reminder->priority === 'High' ? 'selected' : '' }}>High</option>
                <option value="Medium" {{ $reminder->priority === 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="Low" {{ $reminder->priority === 'Low' ? 'selected' : '' }}>Low</option>
            </select>
        </template>
    </td>

    <!-- Estado -->
    <td class="px-6 py-4">
        <template x-if="!isEditing">
            <span class="px-2 py-1 rounded text-white"
                  style="background-color: {{ $reminder->status === 'Completed' ? '#28a745' : ($reminder->status === 'In progress' ? '#ffc107' : '#dc3545') }}">
                {{ $reminder->status }}
            </span>
        </template>
        <template x-if="isEditing">
            <select name="status" class="w-full px-3 py-2 border rounded-md shadow-sm">
                <option value="Completed" {{ $reminder->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                <option value="In progress" {{ $reminder->status === 'In progress' ? 'selected' : '' }}>In progress</option>
                <option value="Pending" {{ $reminder->status === 'Pending' ? 'selected' : '' }}>Pending</option>
            </select>
        </template>
    </td>

    <!-- Fecha de vencimiento -->
    <td class="px-6 py-4 text-gray-800 dark:text-gray-200">
        <template x-if="!isEditing">
            <span>{{ \Carbon\Carbon::parse($reminder->due_date)->format('M d, Y') }}</span>
        </template>
        <template x-if="isEditing">
            <input type="datetime-local" name="due_date" value="{{ \Carbon\Carbon::parse($reminder->due_date)->format('Y-m-d\TH:i') }}" class="w-full px-3 py-2 border rounded-md shadow-sm" />
        </template>
    </td>

    <!-- Botones -->
    <td class="px-6 py-4">
        <div class="flex space-x-2">
            <!-- Botón Ver -->
            <a href="{{ route('reminders.show', $reminder->id) }}" x-show="!isEditing"
               class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded text-sm flex items-center shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm-1 11a1 1 0 112 0 1 1 0 01-2 0zm1-2a1 1 0 01-1-1V7a1 1 0 112 0v3a1 1 0 01-1 1z" />
                </svg>
                View
            </a>

            <!-- Botón Editar -->
            <button @click="isEditing = true" x-show="!isEditing"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded text-sm flex items-center shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M17.414 2.586a2 2 0 010 2.828l-9.9 9.9a2 2 0 01-.708.466l-4.267 1.422a1 1 0 01-1.265-1.265l1.422-4.267a2 2 0 01.466-.708l9.9-9.9a2 2 0 012.828 0zm-2.828 1.414L6.586 12H9v2.414l7.586-7.586-2.828-2.828z" />
                </svg>
                Edit
            </button>

            <!-- Botón Guardar -->
            <form action="{{ route('reminders.update', $reminder->id) }}" method="POST" x-show="isEditing" class="inline">
                @csrf
                @method('PUT')
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    Save
                </button>
            </form>

            <!-- Botón Cancelar -->
            <button @click="isEditing = false" x-show="isEditing"
                    class="bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded">
                Cancel
            </button>

            <!-- Botón Eliminar -->
            <form action="{{ route('reminders.destroy', $reminder->id) }}" method="POST" x-show="!isEditing" class="inline">
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
