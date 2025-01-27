
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
