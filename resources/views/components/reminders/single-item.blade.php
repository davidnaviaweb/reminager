<div x-data="{ isEditing: false }">
    <div class="flex flex-col sm:flex-row gap-8 mb-10 sm:mb-20">
        <div class="w-full sm:w-1/2">
            <h3 class="flex items-center text-2xl font-semibold text-gray-950 dark:text-gray-50 gap-2 mb-4">
                <x-reminders.type-badge :type="$reminder->type"/>
                {{ $reminder->name }}
            </h3>
            <h4 class="flex items-center text-lg font-normal text-gray-500 dark:text-gray-400 gap-2 mb-4">
                <x-heroicon-c-calendar-days class="w-6 h-6 text-gray-700 dark:text-gray-300"/>
                <span class="text-base font-semibold text-gray-600 dark:text-gray-300">
                            {{ \Carbon\Carbon::parse($reminder->due_date)->format('d-m-Y @ H:i') }}
                        </span>
            </h4>
            <p class="text-gray-700 dark:text-gray-300">
                {{ $reminder->description ?? 'No description provided.' }}
            </p>
        </div>
        <div class="flex w-full sm:w-1/2 gap-4 border-t sm:border-none pt-6 sm:pt-0">
            <div class="flex flex-col w-1/4 items-center justify-start">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Priority</h4>
                <x-reminders.priority-badge :priority="$reminder->priority"/>
            </div>
            <div class="flex flex-col w-1/4 items-center justify-start">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Status</h4>
                <x-reminders.status-badge :status="$reminder->status"/>
            </div>
            <div class="flex flex-col w-1/2 items-center justify-start">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Labels</h4>
                <x-reminders.labels-list :labels="$reminder->labels" :justify="'start'"/>
            </div>
        </div>
    </div>
</div>
