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
