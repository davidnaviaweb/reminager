<div x-data="{ showForm: false }" class="mb-6 flex flex-col">
    <div class="flex justify-center lg:justify-end">
        <button @click="showForm = !showForm"
                class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg text-xl shadow-lg flex items-center justify-center">
            <x-heroicon-c-plus class="w-10 h-10 me-2"/>
            {{ __('New Reminder') }}
        </button>
    </div>
    <div x-show="showForm" x-transition class="mt-4 p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg">
        <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Create New Reminder</h2>
        @php
            $reminder = new \App\Models\Reminder();
            $reminder->id = 0;
            $reminder->type = \App\Enums\ReminderType::TASK->value;
        @endphp
        <x-reminders.form
            :action="route('reminders.store')"
            :method="'POST'"
            :on-submit="'showForm = false'"
            :on-cancel="'showForm = false'"
            :submit-label="__('Create')"
            :reminder="$reminder"
            :labels="$labels"
        />
    </div>
</div>
