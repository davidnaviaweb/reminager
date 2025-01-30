<?php

use App\Enums\ReminderPriority;
use App\Enums\ReminderStatus;
use App\Enums\ReminderType;

?>
<div class="mb-6">
    <form method="GET" action="{{ route('reminders.index') }}" class="flex flex-wrap lg:flex-nowrap justify-center gap-2">
        <div class="flex flex-col min-w-40">
            <select name="label" id="label_filter"
                    class="px-4 py-2 border rounded-md focus:ring focus:ring-blue-500 ">
                <option value="">Filter by label</option>
                @foreach($labels as $label)
                    <option value="{{ $label->name }}" {{ request('label') == $label->name ? 'selected' : '' }}>
                        {{ $label->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col min-w-40">
            <select name="type" id="type_filter"
                    class="px-4 py-2 border rounded-md focus:ring focus:ring-blue-500 min-w-40">
                <option value="">Fiter by type</option>
                @foreach(ReminderType::getValues() as $priority)
                    <option value="{{ $priority }}"
                        {{ request('type') ==  $priority ? 'selected' : '' }}>
                        {{ ReminderType::getConfig( $priority)['label'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col min-w-40">
            <select name="priority" id="priority_filter"
                    class="px-4 py-2 border rounded-md focus:ring focus:ring-blue-500 min-w-40">
                <option value="">Filter by priority</option>
                @foreach(ReminderPriority::getValues() as $priority)
                    <option value="{{ $priority }}"
                        {{ request('priority') ==  $priority ? 'selected' : '' }}>
                        {{ ReminderPriority::getConfig( $priority)['label'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col min-w-40">
            <select name="status" id="status_filter"
                    class="px-4 py-2 border rounded-md focus:ring focus:ring-blue-500 min-w-40">
                <option value="">Filter by status</option>
                @foreach(ReminderStatus::getValues() as $status)
                    <option value="{{ $status }}"
                        {{ request('status') ==  $status ? 'selected' : '' }}>
                        {{ ReminderStatus::getConfig( $status)['label'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col min-w-40">
            <select name="sort" id="sort_by"
                    class="px-4 py-2 border rounded-md focus:ring focus:ring-blue-500 min-w-48">
                <option value="">Sort by</option>
                <option value="due_date.asc"
                    {{ request('sort') == 'due_date.asc' ? 'selected' : '' }}>Due date (soonest)
                </option>
                <option value="due_date.desc"
                    {{ request('sort') == 'due_date.desc' ? 'selected' : '' }}>Due date (latest)
                </option>
                <option value="priority.asc"
                    {{ request('sort') == 'priority.asc' ? 'selected' : '' }}>Priority (high to low)
                </option>
                <option value="priority.desc"
                    {{ request('sort') == 'priority.desc' ? 'selected' : '' }}>Priority (low to high)
                </option>
            </select>
        </div>
        <div class="flex items-center justify-center lg:justify-end items-end w-full">
            <a href="{{ route('reminders.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded-md">
                {{__('Reset filters')}}
            </a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('livewire:navigated', () => {
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
