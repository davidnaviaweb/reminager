<div class="mb-6">
    <form method="GET" action="{{ route('reminders.index') }}" class="flex items-stretch space-x-4">
        <div class="flex flex-col">
            <select name="label" id="label_filter"
                    class="px-4 py-2 border rounded-md focus:ring focus:ring-blue-500 min-w-40">
                <option value="">Filter by label</option>
                @foreach($labels as $label)
                    <option value="{{ $label->name }}" {{ request('label') == $label->name ? 'selected' : '' }}>
                        {{ $label->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col">
            <select name="type" id="type_filter"
                    class="px-4 py-2 border rounded-md focus:ring focus:ring-blue-500 min-w-40">
                <option value="">Fiter by type</option>
                <option value="task" {{ request('type') == 'task' ? 'selected' : '' }}>Task</option>
                <option value="event" {{ request('type') == 'event' ? 'selected' : '' }}>Event</option>
            </select>
        </div>
        <div class="flex flex-col">
            <select name="priority" id="priority_filter"
                    class="px-4 py-2 border rounded-md focus:ring focus:ring-blue-500 min-w-40">
                <option value="">Filter by priority</option>
                <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>
        <div class="flex flex-col">
            <select name="status" id="status_filter"
                    class="px-4 py-2 border rounded-md focus:ring focus:ring-blue-500 min-w-40">
                <option value="">Filter by status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in-progress" {{ request('status') == 'in-progress' ? 'selected' : '' }}>In progress
                </option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <div class="flex flex-col">
            <select name="sort" id="sort_by"
                    class="px-4 py-2 border rounded-md focus:ring focus:ring-blue-500 min-w-52">
                <option value="">Sort by</option>
                <option value="due_date.asc"
                    {{ request('sort') == 'due_date.asc' ? 'selected' : '' }}>Due date (soonest)
                </option>
                <option value="due_date.desc"
                    {{ request('sort') == 'due_date.desc' ? 'selected' : '' }}>Due date (latest)
                </option>
                <option value="priority.desc"
                    {{ request('sort') == 'priority.asc' ? 'selected' : '' }}>Priority (high to low)
                </option>
                <option value="priority.asc"
                    {{ request('sort') == 'priority.desc' ? 'selected' : '' }}>Priority (low to high)
                </option>
            </select>
        </div>
        <div class="flex justify-end items-end w-full">
            <a href="{{ route('reminders.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded-md">
                Reset filters
            </a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filters = document.querySelectorAll('#label_filter, #type_filter, #priority_filter, #status_filter, #sort_by');

        filters.forEach(filter => {
            filter.addEventListener('change', function () {
                const params = new URLSearchParams(window.location.search);

                filters.forEach(f => {
                    if (f.value) {
                        params.set(f.name, f.value);
                    } else {
                        params.delete(f.name);
                    }
                });

                window.location.search = params.toString();
            });
        });
    });
</script>
