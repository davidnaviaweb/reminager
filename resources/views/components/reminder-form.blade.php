<div>
    <form action="{{ $action }}" method="POST" @submit="{{ $onSubmit }}">
        @csrf
        <div class="flex flex-wrap gap-1 justify-between">
            <div class="mb-4 w-1/3 flex-grow flex-shrink-0">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                <input type="text" id="name" name="name" required value="text"
                       class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4 w-1/6">
                <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                <select id="type" name="type" required value="task"
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="task">Task</option>
                    <option value="event">Event</option>
                </select>
            </div>
            <div class="mb-4 w-1/6">
                <label for="priority"
                       class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority</label>
                <select id="priority" name="priority" required
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
            <div class="mb-4 w-1/6">
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                <select id="status" name="status" required
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option selected value="pending">Pending</option>
                    <option value=in-progress">In progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <div class="mb-4 w-1/3 flex-grow flex-shrink-0">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                <textarea id="description" name="description" required
                          class="w-full h-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none">description</textarea>
            </div>
            <div class="mb-4 w-1/6 flex-0 items-stretch">
                <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due
                    Date</label>
                <input type="datetime-local" id="due_date" name="due_date" required value="2025-01-25T10:00"
                       class="w-full h-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4 mt-4 w-full">
                <label for="labels" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Label</label>
                <input type="text" name="labels" id="labels"
                       value="{{ old('label', $reminder->label ?? '') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       placeholder="e.g., Work, Personal, Urgent">
            </div>
        </div>
        <!-- Botones -->
        <div class="flex justify-end space-x-2">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ $submitLabel }}
            </button>
            <button type="button" @click="{{ $onCancel }}"
                    class="bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded">
                {{ __('Cancel') }}
            </button>
        </div>
    </form>
</div>
